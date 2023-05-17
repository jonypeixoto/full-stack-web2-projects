import { StatusBar } from 'expo-status-bar';
import React, { useEffect, useState } from 'react';
import AsyncStorage from 'react-native';
import AppLoading from 'expo-app-loading'; 
import { AntDesign } from '@expo/vector-icons'; 
import { useFonts, Lato_400Regular } from '@expo-google-fonts/lato';
import { StyleSheet, Text, View, ImageBackground, TouchableOpacity, TouchableHighlight, Modal, ScrollView, TextInput } from 'react-native';

export default function App() {

  const image = require('./resources/bg.jpg');

  console.disableYellowBox = true;

  const [tasks, setTasks] = useState([]);

  const [modal,setModal] = useState(false);

  const [taskCurrent,setTaskCurrent] = useState('');

    let [fontsLoaded] = useFonts({
      Lato_400Regular,
    });

    useEffect(()=>{
      //alert('app loading...');

      (async () => {
        try {
          let tasksCurrent = await AsyncStorage.getItem('tasks');
          if(tasksCurrent == null) 
            setTasks([]);
          else
            setTasks(JSON.parse(tasksCurrent));
        } catch (error) {
          // Error saving data
        }
      })();

},[])

  if (!fontsLoaded) {
    return <AppLoading />;
  }

  function deleteTask(id){
    alert('Task with id '+id+' was successfully deleted!');
    let newTasks = tasks.filter(function(val){
        return val.id != id;
    });

    setTasks(newTasks);

    (async () => {
      try {
        let tasksCurrent = await AsyncStorage.getItem('tasks', JSON.stringify(newTasks));
        //console.log('called');
      } catch (error) {
        // Error saving data
      }
    })();

  }

  function addTask(){

      setModal(!modal);

      let id = 0;
      if(tasks.length > 0){
          id = tasks[tasks.length-1].id + 1;
      }

      let task = {id:id,task:taskCurrent};

      setTasks([...tasks,task]);

      (async () => {
        try {
          let tasksCurrent = 
          await AsyncStorage.getItem('tasks', JSON.stringify([...tasks,task]));
        } catch (error) {
          // Error saving data
        }
      })();

  }


  return (
    <ScrollView style={{flex:1}}>
      <StatusBar hidden />
      <Modal
        animationType="slide"
        transparent={true}
        visible={modal}
        onRequestClose={() => {
          Alert.alert('Modal has been closed.');
        }}>
        <View style={styles.centeredView}>
          <View style={styles.modalView}>
            <TextInput onChangeText={text => setTaskCurrent(text)} autoFocus={true}></TextInput>

            <TouchableHighlight
              style={{ ...styles.openButton, backgroundColor: '#2196F3' }}
              onPress={() => addTask()}
              >
              <Text style={styles.textStyle}>Add Task</Text>
            </TouchableHighlight>
          </View>
        </View>
      </Modal>

          <ImageBackground source={image} style={styles.image}>
            <View style={styles.coverView}><Text style={styles.textHeader}>To-Do List - CybertimeUP</Text></View>
          </ImageBackground>

          {
          tasks.map(function(val){
            return (<View style={styles.taskSingle}>
              <View style={{flex:1,width:'100%',padding:10}}>
                  <Text>{val.task}</Text>
              </View>

              <View style={{alignItems:'flex-end',flex:1,padding:10}}>
                <TouchableOpacity onPress={() => deleteTask(val.id)}><AntDesign name="minuscircleo" size={24} color="black" /></TouchableOpacity>
              </View>
          </View>);
          })

          }

          <TouchableOpacity style={styles.btnAddTask} onPress={()=>setModal(true)}><Text 
          style={{textAlign:'center',color:'white'}}>Add Task!
          </Text>
          </TouchableOpacity>

      </ScrollView>
  );
}

const styles = StyleSheet.create({
  image: {
    width:'100%',
    height: 80,
    resizeMode: "cover"
  },
  btnAddTask:{
    width:200,
    padding:8,
    backgroundColor:'gray',
    marginTop:20
  },
  coverView:{
    width:'100%',
    height:80,
    backgroundColor:'rgba(0,0,0,0.5)'
  },
  textHeader:{
    textAlign:'center',
    color:'white',
    fontSize:20,
    marginTop:30,
    fontFamily:'Lato_400Regular'
  },
  taskSingle:{
    marginTop:30,
    width:'100%',
    borderBottomWidth:1,
    borderBottomColor:'black',
    flexDirection:'row',
    paddingBottom:10
  },
  // Styles for our modal
  centeredView: {
    flex: 1,
    justifyContent: "center",
    alignItems: "center",
    backgroundColor:'rgba(0,0,0,0.5)'
  },
  modalView: {
    margin: 20,
    backgroundColor: "white",
    borderRadius: 20,
    padding: 35,
    alignItems: "center",
    shadowColor: "#000",
    shadowOffset: {
      width: 0,
      height: 2
    },
    shadowOpacity: 0.25,
    shadowRadius: 3.84,
    elevation: 5,
    zIndex:5
  },
  openButton: {
    backgroundColor: "#F194FF",
    borderRadius: 20,
    padding: 10,
    elevation: 2
  },
  textStyle: {
    color: "white",
    fontWeight: "bold",
    textAlign: "center"
  },
  modalText: {
    marginBottom: 15,
    textAlign: "center"
  }

});
