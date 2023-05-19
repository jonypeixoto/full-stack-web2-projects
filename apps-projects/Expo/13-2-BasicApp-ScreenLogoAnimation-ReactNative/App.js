import { StatusBar } from 'expo-status-bar';
import React, {useState,useEffect,useRef} from 'react';
import {Animated, StyleSheet, Text, View, Image, TextInput, TouchableOpacity } from 'react-native';

export default function App() {

  const [nome, setNome] = useState('');
  const [email, setEmail] = useState('');
  const [senha, setSenha] = useState('');

  const fadeAnim = useRef(new Animated.Value(0)).current;
  
  const cadastro = () => {
    //alert(nome);
    //alert(email);
    //alert(senha);
    //Fazer chamada no back-end para cadastro.
  }

  useEffect(()=>{

    Animated.timing(fadeAnim, {
      toValue: 1,
      duration: 5000,
    }).start();

    let timeout = setTimeout(function(){
      Animated.timing(fadeAnim, {
        toValue: 0,
        duration: 5000,
      }).start();
    },7000)

    return () => {
      clearTimeout(timeout);
    }

  },[])
  

  return (
    <View style={styles.container}>
      <StatusBar hidden />
      <Animated.View
        style={[
          
          {
            alignItems: 'center',
            justifyContent: 'center',
            width:'100%',
            opacity: fadeAnim, // Bind opacity to animated value

          },
        ]}>
      <Image style={{width:250,height:250}} source={require('./assets/cybertimeup_bg.jpg')} />

      <TextInput placeholder="Seu nome..." style={styles.textInput} onChangeText={text=>setNome(text)} />
      <TextInput placeholder="Seu e-mail..." style={styles.textInput} onChangeText={text=>setEmail(text)} />
      <TextInput secureTextEntry={true} placeholder="Sua senha..." style={styles.textInput} onChangeText={text=>setSenha(text)} />
      
      <TouchableOpacity style={styles.btnCadastro} onPress={()=>cadastro()}>
        <Text style={{color:'white',textAlign:'center'}}>CADASTRAR!</Text>
      </TouchableOpacity>
      </Animated.View>
    </View>
  );
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
