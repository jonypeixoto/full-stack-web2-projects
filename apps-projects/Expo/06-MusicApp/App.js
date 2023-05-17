import { StatusBar } from 'expo-status-bar';
import React, { useState } from 'react';
import { ImagePropTypes, LogBox, ScrollView, StyleSheet, Text, TouchableOpacity, View } from 'react-native';
import {Audio} from 'expo-av';
import {AntDesign} from '@expo/vector-icons';
import Player from './Player.js';

export default function App() {

  LogBox.ignoreAllLogs(true);

  const [audioIndex,setAudioIndex] = useState(0);

  const [playing,setPlaying] = useState(false);
  
  const [audio,setAudio] = useState(null);

  const [musics,setMusics] = useState([

    {
        name: 'Sweet child of mine',
        artist: 'Guns N Roses',
        playing: false,
        file: require('./audio.mp3')
    },

    {
        name: 'Welcome to the jungle',
        artist: 'Guns N Roses',
        playing: false,
        file: {uri:'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3'}
    },
    {
      name: 'Welcome to the jungle',
      artist: 'Guns N Roses',
      playing: false,
      file: {uri:'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3'}
  },
  ]);

  const changeMusic = async (id) =>{
      let curFile = null;
      let newMusics = musics.filter((val,k)=>{
            if(id == k){
                musics[k].playing = true;
               
                curFile = musics[k].file;
                setPlaying(true);
                setAudioIndex(id);
            }
            else{
                musics[k].playing = false;
            }

            return musics[k];
      })

      if(audio != null){
          audio.unloadAsync();
      }

      let curAudio = new Audio.Sound();

      try{
          await curAudio.loadAsync(curFile);
          await curAudio.playAsync();
      }catch(error){}

      setAudio(curAudio);
      setMusics(newMusics);

  }

  return (
     <View style={{flex:1}}>
      <ScrollView style={styles.container}>
          <StatusBar hidden />
          <View style={styles.header}>
            <Text style={{textAlign:'center',color:'white',fontSize:25}}>Music App</Text>
          </View>

          <View style={styles.table}>
              <Text style={{width:'50%',color:'rgb(200,200,200)'}}>Music</Text>
              <Text style={{width:'50%',color:'rgb(200,200,200)'}}>Artist</Text>
          </View>


          {
            musics.map((val,k)=>{
                
                if(val.playing){
                    //Render something here.
                    return(
                    <View style={styles.table}>
                        <TouchableOpacity onPress={()=>changeMusic(k)}  style={{width:'100%',flexDirection:'row'}}>
                            <Text style={styles.tableTextSelected}><AntDesign name="play" size={15} 
                            color="#1DB954" /> {val.name}</Text>
                            <Text style={styles.tableTextSelected}>{val.artist}</Text>
                        </TouchableOpacity>
                    </View>
                    );
                }else{
                  //Render something else here.
                  return(
                    <View style={styles.table}>
                        <TouchableOpacity onPress={()=>changeMusic(k)} style={{width:'100%',flexDirection:'row'}}>
                            <Text style={styles.tableText}><AntDesign name="play" size={15} 
                            color="white" /> {val.name}</Text>
                            <Text style={styles.tableText}>{val.artist}</Text>
                        </TouchableOpacity>
                    </View>
                    );
                }

            })
          }

          
        <View style={{paddingBottom:200}}></View>
        
      </ScrollView>
      <Player playing={playing}  setPlaying={setPlaying} setAudioIndex={setAudioIndex} audioIndex={audioIndex} musics={musics} setMusics={setMusics} audio={audio} setAudio={setAudio}>
      </Player>
      </View>
      
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#222'
  },
  header:{
    backgroundColor:'#1DB954',
    width:'100%',
    padding:20
  },
  table:{
    flexDirection:'row',
    padding:20,
    borderBottomColor:'white',
    borderBottomWidth:1
  },
  tableTextSelected:{width:'50%',color:'#1DB954'},
  tableText:{width:'50%',color:'white'}
});
