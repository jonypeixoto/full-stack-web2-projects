import { StatusBar } from 'expo-status-bar';
import React, {useEffect, useState} from 'react';
import { StyleSheet, Text, View, TouchableOpacity } from 'react-native';
import { Audio } from 'expo-av';
import {Picker} from '@react-native-picker/picker';
import { LinearGradient } from 'expo-linear-gradient';

export default function Counter(props) {

    var done = false;

    useEffect(()=>{

        const timer = setInterval(()=>{

            props.setSeconds(props.seconds-1);

            if(props.seconds <= 0 ){
                if(props.minutes > 0){
                    props.setMinutes(minutes-1);
                    props.setSeconds(59);
                }else{
                    if(!done){
                        done = true;
                        props.setStatus('select');
                        props.setMinutes(0);
                        props.setSeconds(1);
                        alert('Finished!');
                        playSound();
                    }
                }
            }


        },1000)

      return () => clearInterval(timer);

    })

    async function playSound(){
        const soundObject = new Audio.Sound();
            try {
            var alarm;
            props.alarms.map(function(val){
                if(val.selected){
                    alarm = val.file;
                }
            })
            await soundObject.loadAsync(alarm);
            await soundObject.playAsync();
            // Your sound is playing!

            // Don't forget to unload the sound from memory
            // when you are done using the Sound object
            } catch (error) {
            // An error occurred!
            }
    }

    function reset(){
        props.setStatus('select');
        props.setMinutes(0);
        props.setSeconds(1);
    }

    function formatNumber(number){
        var finalNumber = "";
         if(number < 10){
            finalNumber = "0"+number;
         }else{
            finalNumber = number;
         }
            return finalNumber;
    }

    var seconds = formatNumber(props.seconds);
    var minutes = formatNumber(props.minutes);

    return(
    
    <View style={styles.container}>
      <StatusBar style="auto" />
      <LinearGradient
        // Background Linear Gradient
        colors={['rgb(0, 2, 115)', 'rgba(0, 0, 0, 0)']}
        style={{
          position: 'absolute',
          left: 0,
          right: 0,
          top: 0,
          height:'100%'
        }}
      />    

      <View style={{flexDirection:'row'}}>
          <Text style={styles.textCounter}>{minutes} : </Text>
          <Text style={styles.textCounter}>{seconds}</Text>
      </View>

      <TouchableOpacity onPress={()=>reset()} style={styles.btnStart}><Text style={{textAlign:'center',paddingTop:30,color:'white',fontSize:20}}>Reset</Text></TouchableOpacity>

    </View>
    
    
    );

}
  
  const styles = StyleSheet.create({
    container:{
      flex:1,
      //backgroundColor: 'rgb(80 ,50, 168)',
      alignItems: 'center',
      justifyContent: 'center'
    },
    textCounter:{
        color:'white',
        fontSize:40
    },
    btnStart:{
        backgroundColor:'rgb(79, 120, 255)',
        width:100,
        height:100,
        borderRadius:50, 
        marginTop:30,
        borderColor:'white',
        borderWidth:2
      }

  });
  