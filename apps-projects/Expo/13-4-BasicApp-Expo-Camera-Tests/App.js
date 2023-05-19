import React, { useState, useEffect, useRef } from 'react';

import { StyleSheet, Text, View, TouchableOpacity, Image } from 'react-native';

import { Camera } from 'expo-camera';



export default function App() {

  const [hasPermission, setHasPermission] = useState(null);

  const [type, setType] = useState(Camera.Constants.Type.back);

  const [picture,setPicture] = useState('');

  const ref = useRef(null)

  useEffect(() => {

    (async () => {

      const { status } = await Camera.requestPermissionsAsync();

      setHasPermission(status === 'granted');

    })();

  }, []);



  async function takePicture(){

     let photo =  await ref.current.takePictureAsync();

     console.log(photo.uri);

     setPicture(photo.uri);

  }



  if (hasPermission === null) {

    return <View />;

  }

  if (hasPermission === false) {

    return <Text>No access to camera</Text>;

  }

  return (

    <View style={styles.container}>

      {

      (picture == '')?

      <Camera style={styles.camera} type={type} ref={ref}>

        <View style={styles.buttonContainer}>

          {

            /*

          <TouchableOpacity

            style={styles.button}

            onPress={() => {

              setType(

                type === Camera.Constants.Type.back

                  ? Camera.Constants.Type.front

                  : Camera.Constants.Type.back

              );

            }}>

            <Text style={styles.text}> Flip </Text>



          </TouchableOpacity>

          */

        }

          <TouchableOpacity style={styles.button} onPress={()=>takePicture()}  >

            <Text style={styles.text}>Take Pic</Text>

          </TouchableOpacity>

        </View>

      </Camera>

      :

      <View>

        <Image style={{width:300,height:300}} source={{uri:picture}} />

        <TouchableOpacity onPress={()=>setPicture('')}><Text>DELETE</Text></TouchableOpacity>

        </View>

      }

      

    </View>

  );

}



const styles = StyleSheet.create({

  container: {

    flex: 1,

  },

  camera: {

    flex: 1,

  },

  buttonContainer: {

    flex: 1,

    backgroundColor: 'transparent',

    flexDirection: 'row',

    margin: 20,

  },

  button: {

    flex: 0.1,

    alignSelf: 'flex-end',

    alignItems: 'center',

  },

  text: {

    fontSize: 18,

    color: 'white',

  },

});
