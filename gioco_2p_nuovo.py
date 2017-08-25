#!/usr/bin/python3

import RPi.GPIO as GPIO
import time
import datetime
import random
import sys

from contextlib import ExitStack, contextmanager
from timeit import default_timer



path ="log2P.txt"
END = 5
PUNTI = 0

#Open a file
fo = open(path,"w")
fo.write("------------ START --------------\n")
fo.write(time.ctime()+"\n")
lista =[]
livello = 1#sys.argv[1]
ids = 1#sys.argv[2]
lista.append(livello)

if int(lista[0]) == 1:
    choose = END
    

fo.write("time 1 :" +str(choose)+" secondi \n")



END_POLL = choose
PUNTI = 0

GPIO.setmode(GPIO.BCM)
GPIO.setup(4,GPIO.OUT)


GPIO.cleanup()
time.sleep(.1)
GPIO.setmode(GPIO.BCM)
GPIO.setwarnings(False)

punti = 0
punteggio = 0


start_mini = 0
start = time.time()


seconds_mini = 0
seconds = 0
finish_mini = 0


#OUTPUT
GPIO.setup(4, GPIO.OUT) #SX
GPIO.setup(17, GPIO.OUT) #DX


#INPUT
GPIO.setup(5,GPIO.IN, pull_up_down=GPIO.PUD_DOWN) #SX
GPIO.setup(6,GPIO.IN,pull_up_down=GPIO.PUD_DOWN) #DX


#output
GPIO.output(4,True)
GPIO.output(17,True)

TEMPO_MAXPOINT = 0




def end_time(tempopunti):
    end = time.time()
    temp = end -start
    hours = temp//3600
    temp = temp - 3600*hours
    minutes = temp//60
    seconds = temp - 60*minutes
    
    if tempopunti == 1:
            print('tempopunti',tempopunti)
            global TEMPO_MAXPOINT
            TEMPO_MAXPOINT = seconds
            print('tempomaxpoint',TEMPO_MAXPOINT)
    if int(seconds) >= END:
        print(TEMPO_MAXPOINT)
        #chiudo il log
        #fo.write("fn(end_minitime) punteggio =>" +str(punteggio) + " \n")
        #fo.write(time.ctime()+" FINE GIOCO \n\n")
        #fo.close()
        GPIO.cleanup()
        time.sleep(.5)
        print(str(PUNTI) +":",float(TEMPO_MAXPOINT))
        fo.close()
        sys.exit()











def end_minitime(chIn, chOut, punti):
    global punteggio
    curr_time = time.time()
    finish_mini = start_mini + END_POLL
   # print ("start",start_mini)
   # print ("curr",curr_time)
   # print ("finish",finish_mini)
    time.sleep(.1)
    #time.sleep(8)
    while time.time() <= finish_mini:
        if GPIO.input(chIn):
            print("Colpito ")
            end_time(1)
            GPIO.output(chOut,True)
            punteggio +=1
            print("punto --",punteggio)
            fo.write("fn(end_minitime COLPITO => punteggio :" + str(punteggio)+"\n\n")
            time.sleep(.1)
            return punteggio
        #time.sleep(.30)
    sec = curr_time - start_mini
    print("TIME:  => Non hai premuto nulla")
    fo.write("fn(end_minitime) Non hai premuto nulla \n")
    time.sleep(.1)
    return punteggio  
    



def pressed(num, punti):

    global punteggio
    global start_mini
    global PUNTI
    start_mini = 0


    
    while num == 1:
        if punti == "None" or punti == "":
            punti = 0
        fo.write("fn(pressed): num "+str(num)+"\t punti:"+str(punti)+"\n")            
        start_mini = time.time()    
        punteggio = end_minitime(5,4,punti)
        
        PUNTI = punteggio
        fo.write("fn(pressed): SPENGO IL DISPLAY: 1 \n")
        print("4,True")
        GPIO.output(4,True)
        return punteggio
        

    while num == 2:
        
        if punti == "None":
            punti = 0
        fo.write("fn(pressed): num "+str(num)+"\t punti:"+str(punti)+"\n") 
        start_mini = time.time()    
        punteggio = end_minitime(6,17,punti)
        PUNTI = punteggio
        fo.write("fn(pressed): SPENGO IL DISPLAY: 2 \n")
        print("17,True")
        GPIO.output(17,True)
        punti = punteggio
        return punti
   
    

    

fo.write("entro in while \n")
fo.write("Azzero i punti \n")
punti = 0
time.sleep(.1)
#import pygame
#pygame.mixer.init()
#pygame.mixer.music.load("/home/pi/GIOCO/Gioco30sec.mp3")
#pygame.mixer.music.play()
while True:

        numeroRandom = random.randint(1,2)
       
        
        if numeroRandom == 1:
           start_mini = time.time()
           punti=GPIO.output(4,False)
           punti = pressed(1,punti)
            

        if numeroRandom == 2:
            start_mini = time.time()
            print("17,False")
            GPIO.output(17,False)
            punti =pressed(2,punti)
          

        
