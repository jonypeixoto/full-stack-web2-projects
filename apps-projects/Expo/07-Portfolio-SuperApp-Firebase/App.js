import * as React from 'react';
import { useEffect, useState } from 'react';
import { View, Text, TouchableOpacity, LogBox, StyleSheet, StatusBar, ScrollView, Dimensions, Image, TextInput } from 'react-native';
import { NavigationContainer } from '@react-navigation/native';
import { createNativeStackNavigator } from '@react-navigation/native-stack';
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs';
import Ionicons from 'react-native-vector-icons/Ionicons';
import Modal from './Modal.js';
import * as WebBrowser from 'expo-web-browser';


function HomeScreen({navigation}) {

  // Do not show errors 
  // Put FALSE to show errors

  LogBox.ignoreAllLogs(true);

  return (
    <View style={{padding:15,flex:1}}>
      <ScrollView contentContainerStyle={{padding:20}} style={styles.container}>
        <Text style={styles.textHeader}>Where do you want to navigate?</Text>

      <TouchableOpacity onPress={()=>navigation.navigate('Home')} style={styles.btnNavigation}>
        <Ionicons name="md-home" size={29} color='white' />
        <Text style={{color:'white',marginTop:8,marginLeft:8}}>Home</Text>
      </TouchableOpacity>

      <TouchableOpacity onPress={()=>navigation.navigate('About')} style={styles.btnNavigation}>
        <Ionicons name="ios-information-circle" size={29} color='white' />
        <Text style={{color:'white',marginTop:8,marginLeft:8}}>About</Text>
      </TouchableOpacity>

      <TouchableOpacity onPress={()=>navigation.navigate('Portfolio')} style={styles.btnNavigation}>
        <Ionicons name="ios-list" size={29} color='white' />
        <Text style={{color:'white',marginTop:8,marginLeft:8}}>Portfolio</Text>
      </TouchableOpacity>

      </ScrollView>
    
    </View>
  );
}

function AboutScreen({navigation}) {

  const [showModal,setModal] = useState(false);


  const openModalContact = () =>{
    setModal(!showModal);
  }

  let widthWindow = Dimensions.get('window').width - 30 - 40;
  return (
    <View style={{ padding:15,flex:1}}>

      {
        (showModal)?
        <Modal />
        :
        <View></View>
      }

    <View style={{padding:10,flex:1}}>

    <ScrollView contentContainerStyle={{padding:20}} style={styles.container}>
      <Text style={styles.textHeader}>About</Text>

      <Image style={{width:widthWindow,height:widthWindow,marginTop:20}} source={{uri:'https://pbs.twimg.com/profile_images/1387416562412539908/EYmir6ft_400x400.jpg'}} />
      <View>
        <Text style={{fontSize:20,marginTop:10}}>Jony Peixoto / CEO</Text>
        <Text style={{fontSize:16,marginTop:10}}>I discovered my passion for engineering when I was 7 years old in my house; It was then when it became clear what I wanted to do for a living.
        <View></View>
        I pursued my career at the amazing SENAI CETIQT College where I started my major in Internet Engineering, specially, Motion Programming.
        <View></View>
        A year later I took a begginer’s Web class, where I discovered the love for do business as an entrepreneur and code.
        <Text>

        </Text>
        After that, I switched my major to Interactive Design and started the never-ending journey of becoming a web/mobile developer along with sharpening my eye for programming together with engineering.
        </Text>

        <TouchableOpacity onPress={()=>openModalContact()} style={{...styles.btnNavigation,justifyContent:'center'}}>
          <Text style={{color:'white',fontSize:17}}>Contact Me!</Text>
        </TouchableOpacity>

      </View>

    </ScrollView>

    </View>

    </View>
  );
}

function PortfolioScreen({navigation,route}) {

  const[images,setImages] = useState([
    {
      img: require('./resources/img1.png'),
      width:0,
      height:0,
      ratio:0,
      website:'https://jonypeixoto.com'
    },
    {
      img: require('./resources/img2.png'),
      width:0,
      height:0,
      ratio:0,
      website:'https://jonypeixoto.com'
    }
  ])

  const [windowWidth,setWindowWidth] = useState(0);

  useEffect(()=> {

    let windowWidthN = Dimensions.get('window').width;

    setWindowWidth(windowWidthN - 30 - 40);

    let newImages = images.filter(function(val){
        let w = Image.resolveAssetSource(val.img).width;
        let h = Image.resolveAssetSource(val.img).height;

        val.width = w; 
        val.height = h; 

        val.ratio = h/w;

        return val;

    })

    setImages(newImages);
    
  }, [])

  const openBrowser = async (website) =>{
    let result = await WebBrowser.openBrowserAsync(website);
  }

  return (
    <View style={{padding:15,flex:1}}>
    <ScrollView contentContainerStyle={{padding:20}} style={styles.container}>
      <Text style={styles.textHeader}>The latest projects!</Text>

      {
        images.map(function(val){
          return (
            <View style={styles.parentImage}>
              <Image 
              style={{width:windowWidth,height:windowWidth*val.ratio,resizeMode:'stretch'}} source={val.img} />

              <TouchableOpacity onPress={()=>openBrowser(val.website)} style={styles.buttonOpenBrowser}>
                <Text style={{textAlign:'center',color:'white',fontSize:18}}>Open in browser!</Text>
              </TouchableOpacity>

            </View>
          )
        })
      }

    </ScrollView>

    </View>

  );
}


const Tab = createBottomTabNavigator();

function App() {
  return (
    <NavigationContainer>

      <StatusBar hidden />

      <Tab.Navigator
        screenOptions={({ route }) => ({
          tabBarIcon: ({ focused, color, size }) => {
            let iconName;

            if (route.name === 'Home') {
              iconName = focused
                ? 'ios-home'
                : 'ios-home';
            } else if (route.name === 'Portfolio') {
              iconName = focused ? 'ios-list' : 'ios-list';
            }else if(route.name == 'About'){
              iconName = focused ? 'ios-information-circle' : 'ios-information-circle';
            }

            // You can return any component that you like here!
            return <Ionicons name={iconName} size={size} color={color} />;
          },
          tabBarActiveTintColor: 'darkblue',
          tabBarInactiveTintColor: 'gray',
        })}
      >
        <Tab.Screen name="Home" component={HomeScreen} />
        <Tab.Screen name="About" component={AboutScreen} />
        <Tab.Screen name="Portfolio" component={PortfolioScreen} />
      </Tab.Navigator>
    </NavigationContainer>
  );
}

export default App;

const styles = StyleSheet.create({
  container:{
    backgroundColor:'white'
  },
  textHeader:{
    color:'#5f5380',
    fontSize:24
  },
  btnNavigation:{
    backgroundColor:'darkblue',
    padding:20,
    marginTop:15,
    flexDirection:'row'
  },
  parentImage:{
    marginTop:30
  },
  buttonOpenBrowser:{
    padding:10,
    backgroundColor:'darkblue'
  },
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
  }
})