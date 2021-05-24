#!/bin/bash

if [ $1 == "start" ] 
then	
	echo `kubectl create -f $2`

elif [ $1 == "stop" ]
then 
	echo `kubectl delete -f $2`
fi	
