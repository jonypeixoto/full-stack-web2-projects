import React,{useEffect,useState} from 'react';
import { View, Text, Button, ImageBackground, StyleSheet, TouchableOpacity, Image, ScrollView } from 'react-native';
import { NavigationContainer } from '@react-navigation/native';
import * as firebase from 'firebase';
import { createStackNavigator } from '@react-navigation/stack';
import {db} from './firebase.js';


function HomeScreen({navigation}) {

  const [news,setNews] = useState([]);

  useEffect(()=>{
    db.collection('news').orderBy('date', 'desc').onSnapshot(snapshot=>{
        setNews(snapshot.docs.map(function(doc){
            return {info:doc.data()}
        }));
    })
  },[])
 
  return (
    <View style={{flex:1}}>
    <View style={{ flex:0.3 }}>
    <ScrollView horizontal contentContainerStyle={{width:'200%',height:'100%',backgroundColor:'red'}} style={{flex:1}}>


    {
        news.map((val,index)=>{
            if(index < 2){
                return (
                  <ImageBackground style={styles.image} source={{ uri: val.info.image }} >
                  <TouchableOpacity onPress={()=>navigation.navigate('News',{
                    title: val.info.title,
                    content: val.info.content,
                    image: val.info.image
                  })} style={{
    
                      width:'100%',
                      height:'100%',
                      backgroundColor:'rgba(0,0,0,0.4)',
                      justifyContent:'flex-end'
    
                  }}>
                  <Text style={{fontSize:27,color:'white'}}>{val.info.title}</Text>
                  </TouchableOpacity>
                </ImageBackground>
                )
            }
        })
  
      }


      </ScrollView>

    </View>

        <View style={{flex:0.7,padding:20}}>
            <View style={{width:35,height:2,backgroundColor:'#069',position:'absolute',left:40,top:40
          

          
            }}></View>
            <Text>More News</Text>

            <ScrollView contentContainerStyle={{padding:20}} style={{flex:1}}>

            {
              news.map((val,index)=>{
                if(index >= 2){
                  return (
                    <View style={{flexDirection:'row',marginBottom:10}}>
                      <TouchableOpacity style={{flexDirection:'row'}} onPress={()=>navigation.navigate('News',{
                        title: val.info.title,
                        content: val.info.content,
                        image: val.info.image
                      })}>
                      <Image source={{ uri: val.info.image}} style={{width:100,height:100}} />
                      <Text style={{padding:10}}>{val.info.title}</Text>
                      </TouchableOpacity>
                    </View>
                  )}
              })
            }
               
            </ScrollView>

        </View>

    </View>
  );
}

function NewsScreen({ route,navigation }) {
  return (
    <View style={{flex:1}}>
    <ScrollView style={{ flex:1 }}>
      <ImageBackground style={styles.imageContent} source={{ uri: route.params.image }} >
          <View style={{
            width:'100%',
            height:'100%',
            backgroundColor:'rgba(0,0,0,0.5)',
            justifyContent:'flex-end',
            padding:10
          }}>
            <Text style={{fontSize:27,color:'white'}}>{route.params.title}</Text>
          </View>
      </ImageBackground>
      <View style={{flex:1}}>
        <Text style={{
          fontSize:15,
          padding:20
        }}>{route.params.content}</Text>
      </View>
    </ScrollView>
    </View>
  );
}


const Stack = createStackNavigator();

function App() {
  return (
    <NavigationContainer>
      <Stack.Navigator>
          <Stack.Screen name="Portal" component={HomeScreen} />
          <Stack.Screen name="News" component={NewsScreen} />
      </Stack.Navigator>
    </NavigationContainer>
  );
}
const styles = StyleSheet.create({
  image: {
    flex: 1, 
    resizeMode: 'cover',
    justifyContent: 'flex-end',
    width:'100%'
  },

  imageContent: {
    flex: 0.5, 
    resizeMode: 'cover',
    width:'100%',
    height:200
  }

})
export default App;