#!/usr/bin/env python
# 
# Maginon Wi-Fi Smart Plug Protocol Client
# For use with TP-Link HS-100 or HS-110
#  
# by Lubomir Stroetmann
# Copyright 2016 softScheck GmbH 
# 
# Licensed under the Apache License, Version 2.0 (the "License");
# you may not use this file except in compliance with the License.
# You may obtain a copy of the License at
# 
#      http://www.apache.org/licenses/LICENSE-2.0
# 
# Unless required by applicable law or agreed to in writing, software
# distributed under the License is distributed on an "AS IS" BASIS,
# WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
# See the License for the specific language governing permissions and
# limitations under the License.
# 
###
import socket
import argparse
import json
import time
import datetime
import sys
import telnetlib

# Check if IP is valid
def validIP(ip):
	try:
		socket.inet_pton(socket.AF_INET,ip)
	except socket.error:
		parser.error("Invalid IP Address.")
	return ip

# Predefined Smart Plug Commands
commands = {'infos',
			'on',
			'off'
}

# Parse commandline arguments
parser = argparse.ArgumentParser(description="Maginon Wi-Fi Smart Plug Client v1")
parser.add_argument("-t", "--target", metavar="<ip>", required=True, help="Target IP Address", type=validIP)
group = parser.add_mutually_exclusive_group(required=True)
group.add_argument("-c", "--command", metavar="<command>", help="Preset command to send. Choices are: "+", ".join(commands), choices=commands) 
args = parser.parse_args()

resultat = ''

# Set target IP, port and command to send
HOST = args.target
user = "admin"
password = "admin"

# Send command and receive reply 
try:
## Maginon	
	if args.command  == "infos":
		tn = telnetlib.Telnet(HOST)

		tn.read_until("login: ")
		tn.write(user + "\n")
		if password:
		    tn.read_until("Password: ")
		    tn.write(password + "\n")

		tn.read_until("commands.", 2)
		tn.write("GetInfo W\n")
		tn.write("GetInfo V\n")
		tn.write("GetInfo I\n")
		tn.write("GetInfo E\n")
		tn.write("exit\n")
		response = tn.read_all()
		tn.close()
		#print response

		for line in response.split('\n'):
			if line.startswith("$01W"):
				power =  '"puissance" : ' + str(float(line[7:11]+ '.' + line[11:]))
				if float(line[7:11]+ '.' + line[11:]) > 0.3:
					etat = 1
				else: etat = 0
			elif line.startswith("$01V"):
				voltage = ', "tension" : ' + str(float(line[7:10] + '.' + line[10:]))
			elif line.startswith("$01I"):
				intensite =  ', "intensite" : ' + str(float(line[7:9]+ '.' + line[9:]))
			elif line.startswith("$01E"):
				compteur = ', "compteur" : ' + str(float(line[7:11]+ '.' + line[11:]))

		print '{'
		print power
		print voltage
		print intensite
		print compteur
		print ', "relay_state":' + str(etat) + '}'

	if args.command  == "on" :
		tn = telnetlib.Telnet(HOST)

		tn.read_until("login: ")
		tn.write(user + "\n")
		if password:
		    tn.read_until("Password: ")
		    tn.write(password + "\n")

		tn.write("GpioForCrond 1\n")
		tn.write("exit\n")
		response = tn.read_all()
		tn.close()

	if args.command  == "off" :
		tn = telnetlib.Telnet(HOST)
		tn.read_until("login: ")
		tn.write(user + "\n")
		if password:
		    tn.read_until("Password: ")
		    tn.write(password + "\n")

		tn.write("GpioForCrond 0\n")
		tn.write("exit\n")
		response = tn.read_all()
		tn.close()

except socket.error:
	quit("Cound not connect telnet to host " + ip )


