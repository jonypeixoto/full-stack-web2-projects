import { StatusBar } from 'expo-status-bar';
import Constants from 'expo-constants';
import React,{useState, useEffect} from 'react';
import { StyleSheet, Text, View, TouchableOpacity } from 'react-native';
import Button from './Button';

export default function App() {

  console.disableYellowBox = true;
  const [firstNumber, setFirstNumber] = useState(0);
  const [secondNumber, setSecondNumber] = useState(0);
  const [signal, setSignal] = useState("");


  const [stringCalculus, setStringCalculus] = useState("0");

  var numbers = [];

  for(var i = 0; i <= 9; i++){
      numbers.push(i);
  }

  function logicalCalculator(n){
    if(signal == ""){
        setFirstNumber(parseInt(firstNumber.toString() + n.toString()));
        setStringCalculus(parseInt(firstNumber.toString() + n.toString()));
    }

    if((n == "/" || n == "*" || n == "+" || n == "-") && secondNumber == 0){
        setStringCalculus(firstNumber.toString() + n);
        setSignal(n);
    }

    if(signal != ""){
      setSecondNumber(parseInt(secondNumber.toString() + n.toString()));
      setStringCalculus(firstNumber+signal+parseInt(secondNumber.toString() + n.toString()));
    }

    if(n == "="){
      let result = 0;
      if(signal === "+"){
        result = firstNumber+secondNumber;
      }else if(signal == "-"){
        result = firstNumber-secondNumber;
      }
      else if(signal == "/"){
        result = firstNumber/secondNumber;
      }
      else if(signal == "*"){
        result = firstNumber*secondNumber;
      }
      setStringCalculus(result);
      setSignal("");
      setFirstNumber(result);
      setSecondNumber(0);
    }

  }

  return (
    <View style={{flex:1,backgroundColor:'black'}}>
    <StatusBar hidden />
    <View style={styles.top}><Text style={{fontSize:24,color:'white'}}>{stringCalculus}</Text></View>

    <View style={{flexDirection:'row',height:'16.6%',alignItems:'center'}}>
        <TouchableOpacity onPress={()=>logicalCalculator('+')} style={{width:'20%',backgroundColor:'rgb(20,20,20)'
        ,justifyContent:'center',alignItems:'center',height:'100%'}}>
          <Text style={{fontSize:24,color:'white'}}>+</Text></TouchableOpacity>
        <TouchableOpacity onPress={()=>logicalCalculator('-')} style={{width:'20%',backgroundColor:'rgb(20,20,20)',justifyContent:'center',alignItems:'center',height:'100%'}}>
          <Text style={{fontSize:24,color:'white'}}>-</Text>
          </TouchableOpacity>
        <TouchableOpacity onPress={()=>logicalCalculator('/')} style={{width:'20%',backgroundColor:'rgb(20,20,20)',justifyContent:'center',alignItems:'center',height:'100%'}}>
          <Text style={{fontSize:24,color:'white'}}>/</Text>
          </TouchableOpacity>
        <TouchableOpacity onPress={()=>logicalCalculator('*')} style={{width:'20%',backgroundColor:'rgb(20,20,20)',justifyContent:'center',alignItems:'center',height:'100%'}}>
          <Text style={{fontSize:24,color:'white'}}>*</Text>
          </TouchableOpacity>
          <TouchableOpacity onPress={()=>logicalCalculator('=')} style={{width:'20%',backgroundColor:'rgb(20,20,20)',justifyContent:'center',alignItems:'center',height:'100%'}}>
          <Text style={{fontSize:24,color:'white'}}>=</Text>
          </TouchableOpacity>
      </View>


      <View style={{flexDirection:'row',flexWrap:'wrap',borderTopColor:'black',borderTopWidth:2,height:'66.8%'}}>
          {
            numbers.map(function(e){
            return (<Button logicalCalculator={logicalCalculator} number={e}></Button>);
            })
          }
      </View>
    </View>
  );
}

const styles = StyleSheet.create({
    top:{
      backgroundColor:'rgb(20,20,20)',
      height:'16.6%',
      justifyContent:'center',
      paddingLeft:20
    }
});
