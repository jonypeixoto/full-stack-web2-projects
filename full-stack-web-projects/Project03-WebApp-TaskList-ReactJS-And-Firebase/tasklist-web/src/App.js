import './App.css';
import {useState, useEffect} from 'react';

function App() {

  const [tasks, setTasks] = useState([
    /*
    {
      id: 0,
      task: 'My task of the day',
      finalized: false
    },
    {
      id: 0,
      task: 'My task of the day 2',
      finalized: true
    },
    */

  ]);
  const [modal, setModal] = useState(false);

  const saveTask = () => {
    //TODO: Salvar a tarefa.
    var task = document.getElementById('content-task');

    setTasks([
      ...tasks,
      {
        id: new Date().getTime(),
        task: task.value,
        finalized: false

      }
    ]);

    window.localStorage.setItem('tasks',JSON.stringify([
      ...tasks,
      {
        id: new Date().getTime(),
        task: task.value,
        finalized: false

      }
    ]));

    setModal(false);

  }

  const markCompleted = (id,opt) =>{
        let newTasks = tasks.filter(function(val){
            if(val.id == id){
              val.finalized = opt;
            }

            return val;
        })

        setTasks(newTasks);
        window.localStorage.setItem('tasks',JSON.stringify(newTasks));
  }

  const openModal = () => {
        setModal(!modal);
  }

  const deletTask = (id)=>{
    let newTasks = tasks.filter(function(val){
      if(val.id !== id){
        return val;
      }
  })

  setTasks(newTasks);
  }

  useEffect(()=>{
    //Fazer uma chamada para API e preencher o estado tarefas.
    if(window.localStorage.getItem('tasks') != undefined){
      setTasks(JSON.parse(window.localStorage.getItem('tasks')));
        console.log(window.localStorage.getItem('tasks'));
    }
  },[])

  return (
    <div className="App">
        {
          modal?
          <div className="modal">
            <div className="modalContent">
              <h3>Add your task</h3>
              <input id="content-task" type="text" />
              <button onClick={()=>saveTask()}>Save!</button>
            </div>
          </div>
          :
          <div></div>
        }
        <div onClick={()=>openModal()} className="addTask">+</div>
          <div className="boxAnnotations">
            <h2>My tasks of the day!</h2>                        
            {
              tasks.map((val)=>{
                if(!val.finalized){
                  return (
                      <div className="taskSingle">
                      <p onClick={()=>markCompleted(val.id,true)}>{val.task}</p>
                      <span onClick={()=>deletTask(val.id)} style={{color:'red'}}>(x)</span>
                      </div>
                  );
                }else{
                  return (
                    <div className="taskSingle">
                      <p onClick={()=>markCompleted(val.id,false)} style={{textDecoration:'line-through'}}>{val.task}</p>
                      <span onClick={()=>deletTask(val.id)} style={{color:'red'}}>(x)</span>
                    </div>
                  );
                }
              })
            }
          </div>
    </div>
  );
}

export default App;

// Access the TaskList - WebApp: www.todolist-3a02c.web.app OR www.todolist-3a02c.firebaseapp.com



