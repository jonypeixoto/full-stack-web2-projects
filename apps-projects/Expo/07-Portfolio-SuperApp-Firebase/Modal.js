import * as React from 'react';
import {useEffect,useState} from 'react';
import { View, Text,StyleSheet, TextInput, TouchableOpacity } from 'react-native';
import {db} from './firebase.js';

export default function Modal(props){
    const [name,setName] = useState('');
    const [message,setMessage] = useState('');

    const sendMessage = () =>{
        db.collection('contact').add({
          name: name,
          message: message
        })
        alert('Your message has been sent successfully.');

        setName('');

        setMessage('');
        
    }


    return (
        <View style={styles.modalParent}>
           <View style={{position:'absolute',right:0,top:0,width:50,height:50,backgroundColor:'#333',zIndex:2,justifyContent:'center'}}>
             <TouchableOpacity style={{width:'100%',height:'100%',justifyContent:'center'}} onPress={()=>props.setModal(!props.showModal)}>
            <Text style={{color:'white',textAlign:'center'}}>X</Text></TouchableOpacity>
           </View>
           <View style={styles.boxModal}>
            <Text style={{...styles.textHeader,fontSize:15}}>What's your name?</Text>
              <TextInput onChangeText={(text)=>setName(text)} style={{height:40,width:'100%',borderColor:'#ccc',borderWidth:1,marginBottom:20}} multiline numberOfLines={4}></TextInput>
            <Text style={{...styles.textHeader,fontSize:15}}>What's your message?</Text>
              <TextInput onChangeText={(text)=>setMessage(text)} style={{height:80,width:'100%',borderColor:'#ccc',borderWidth:1,marginBottom:20}} multiline numberOfLines={4}></TextInput>
            <TouchableOpacity onPress={()=>sendMessage()} style={{...styles.btnNavigation,justifyContent:'center'}}>
              <Text style={{color:'white',fontSize:14}}>Send!</Text>
            </TouchableOpacity>
           </View>
        </View>
    );
}

const styles = StyleSheet.create({
  modalParent:{
    position:'absolute',
    left:0,
    top:0,
    width:'100%',
    height:'100%',
    backgroundColor:'rgba(0,0,0,0.6)',
    zIndex:1
  },
  boxModal:{
    backgroundColor:'white',
    height:370,
    width:'100%',
    position:'absolute',
    left:0,
    top:'50%',
    marginTop:-185,
    padding:10
  },
  btnNavigation:{
    backgroundColor:'darkblue',
    padding:20,
    marginTop:15,
    flexDirection:'row'
  }
})