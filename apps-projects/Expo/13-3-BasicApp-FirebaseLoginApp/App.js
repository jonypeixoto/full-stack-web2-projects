import { StatusBar } from 'expo-status-bar';
import React, {useState,useEffect} from 'react';
import { StyleSheet, Text, View, Image, TextInput, TouchableOpacity } from 'react-native';
import {auth} from './firebase';

export default function App() {

  const [email, setEmail] = useState('');
  const [senha, setSenha] = useState('');
  const [user, setUser] = useState('');

  useEffect(() => {
    auth.onAuthStateChanged(function(val){
      if(val != null){
        setUser(val.email);
      }
    })
  }, [])
  
  const login = () => {
        auth.signInWithEmailAndPassword(email,senha).then(function(val){
            console.log(val);
            setUser(val.email);
        }).catch(function(error){
          alert(error.message);
        })
  }

  const logout = ()=>{
    auth.signOut();
    setUser('');
  }

  
  if(!user){
  return (
    <View style={styles.container}>
      <StatusBar hidden />
      
      <Image style={{width:250,height:250}} source={require('./assets/cybertimeup_bg.jpg')} />

      <TextInput placeholder="Seu e-mail..." style={styles.textInput} onChangeText={text=>setEmail(text)} />
      <TextInput secureTextEntry={true} placeholder="Sua senha..." style={styles.textInput} onChangeText={text=>setSenha(text)} />
      
      <TouchableOpacity style={styles.btnCadastro} onPress={()=>login()}>
        <Text style={{color:'white',textAlign:'center'}}>LOGAR!</Text>
      </TouchableOpacity>
      

    </View>
  );
  }else{
    return (
      <View style={styles.container}>
        <StatusBar hidden />
        <Text>Logado com e-mail: {user}</Text>
        <TouchableOpacity style={styles.btnCadastro} onPress={()=>logout()}>
        <Text style={{color:'white',textAlign:'center'}}>LOGOUT!</Text>
      </TouchableOpacity>
  
      </View>
    );
  }
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#000000',
    alignItems: 'center',
    justifyContent: 'center',
    padding: 20
  },
  textInput:{
    width:'100%',
    height:40,
    backgroundColor: 'white',
    borderRadius: 20,
    paddingLeft: 10,
    marginBottom: 10
  },
  btnCadastro:{
    width:'100%',
    height:40,
    backgroundColor:'#03279e',
    borderRadius: 20,
    justifyContent:'center'
  }
});
