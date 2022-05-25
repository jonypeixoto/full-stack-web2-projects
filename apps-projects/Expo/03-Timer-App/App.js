import { StatusBar } from 'expo-status-bar';
import React, {useState} from 'react';
import { StyleSheet, Text, View, TouchableOpacity } from 'react-native';
import {Picker} from '@react-native-picker/picker';
import { LinearGradient } from 'expo-linear-gradient';
import Counter from './Counter';

export default function App() {

  console.disableYellowBox = true;
  const [status,setStatus] = useState('select');
  const [seconds,setSeconds] = useState(1);
  const [minutes,setMinutes] = useState(0);
  const [alarmSound,setAlarmSound] = useState([
    {
      id:1,
      selected: true,
      sound:'alarm 1',
      file: require('./assets/alarm1.mp3')
    },
    {
      id:2,
      selected: false,
      sound:'alarm 2',
      file: require('./assets/alarm2.mp3')
    },
    {
      id:3,
      selected: false,
      sound:'alarm 3',
      file: require('./assets/alarm3.mp3')
    }
  ]);

    var numbers = [];
    for(var i = 1; i<=60; i++){
      numbers.push(i);
    }

    function setAlarm(id){
        let alarmsTemp = alarmSound.map(function(val){
              if(id != val.id)
                val.selected = false;
              else
                val.selected = true;
              return val;
        })

        setAlarmSound(alarmsTemp);
    }

  if(status == 'select'){
  return (
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
      <Text style={{color:'white',fontSize:30}}>Select your Time:</Text>
      <View style={{flexDirection:'row'}}>
          <Text style={{color:'white',paddingTop:16}}>Min: </Text>
      <Picker
        selectedValue={minutes}
        onValueChange={(itemValue, itemIndex) => setMinutes(itemValue)}
        style = {{ height: 50, width: 100,color:'white' }}
        >
        <Picker.Item label='0' value='0' />
        {
        numbers.map(function(val){
          return(<Picker.Item label={val.toString()} value={val.toString()} />);
        })

        }

      </Picker>
      <Text style={{color:'white',paddingTop:16}}>s: </Text>
      <Picker
        selectedValue={seconds}
        onValueChange={(itemValue, itemIndex) => setSeconds(itemValue)}
        style = {{ height: 50, width: 100,color:'white' }}
        >

        {
        numbers.map(function(val){
          return(<Picker.Item label={val.toString()} value={val.toString()} />);
        })

        }


      </Picker>

      </View>

      <View style={{flexDirection:'row'}}>
        {
        alarmSound.map(function(val){
            if(val.selected){
            return (

            <TouchableOpacity onPress={()=>setAlarm(val.id)} style={styles.btnChooseSelected}>
              <Text style={{color:'white'}}>{val.sound}</Text>
            </TouchableOpacity>);
            }else{
                return (
    
                <TouchableOpacity onPress={()=>setAlarm(val.id)} style={styles.btnChoose}>
                  <Text style={{color:'white'}}>{val.sound}</Text>
                </TouchableOpacity>);
            }

        })
        
        }
      </View>
          <TouchableOpacity onPress={()=>setStatus('start')} style={styles.btnStart}><Text style={{textAlign:'center',paddingTop:30,color:'white',fontSize:20}}>Start</Text></TouchableOpacity>
    </View>
    
  );
  }else if(status == 'start'){
      // TODO: TRABALHAMOS A LÓGICA TIMER / CONTADOR.
      return(
        <Counter alarms={alarmSound} setMinutes={setMinutes} setSeconds={setSeconds} setStatus={setStatus} minutes={minutes} seconds={seconds}></Counter>
      );
  }
}

const styles = StyleSheet.create({
  btnStart:{
    backgroundColor:'rgb(79, 120, 255)',
    width:100,
    height:100,
    borderRadius:50, 
    marginTop:30,
    borderColor:'white',
    borderWidth:2
  },
  container: {
    flex: 1,
    //backgroundColor: 'rgb(7,1,165)',
    alignItems: 'center',
    justifyContent: 'center',
  },
  btnChoose:{
    marginRight:10,
    padding:8,
    backgroundColor:'rgb(79, 120, 255)'
  },
  btnChooseSelected:{
    marginRight:10,
    padding:8,
    backgroundColor:'rgba(79, 120, 255, 0.3)',
    borderColor:'white',
    borderWidth:1
  },
});
