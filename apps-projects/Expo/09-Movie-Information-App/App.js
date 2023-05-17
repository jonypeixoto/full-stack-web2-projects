import { StatusBar } from 'expo-status-bar';
import React, {useState,useEffect} from 'react';
import { StyleSheet, Text, View, TouchableOpacity } from 'react-native';

export default function App() {

  const [movies,setMovies] = useState(null);
  const [tabs, setTabs] = useState(0);

  useEffect(()=>{
    fetch('https://api.themoviedb.org/3/movie/popular?api_key=506fadb0256c13349acc05dabebf9604&language=en-US&page=1', {
        method: 'GET'
      })
      .then(response => response.json())
      .then(function(json){

        setMovies(json);




      })
  },[])

  if(movies != null){
    return(
      <View style={styles.container}>
        <StatusBar hidden />
        {
          movies.results.map(function(val){
            if(val.id == tabs){
                return(
                <View>
                    <TouchableOpacity onPress={()=>setTabs(val.id)}>
                        <Text style={{color:'white'}}>{val.original_title}</Text>
                    </TouchableOpacity>
                    <Text style={{color:'white'}}>{val.overview}</Text>
                </View>
                )
            }else{
                return(
                  <View>
                  <TouchableOpacity onPress={()=>setTabs(val.id)}>
                      <Text style={{color:'black'}}>{val.original_title}</Text>
                  </TouchableOpacity>
                  </View>
                )
            }
          })
        }
      </View>
    )
  }else{
      return(

      <View style={styles.container}>
        <Text>Loading...</Text>
      </View>
      )
  }
  
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#069'
  },
});
