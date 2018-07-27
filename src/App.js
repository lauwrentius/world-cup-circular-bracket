import React, { Component } from 'react';
import logo from './logo.svg';
import './App.css';

class App extends Component {
  constructor(props) {
    const URL = "http://api.football-data.org/v2/competitions/2000"

    super(props)
    fetch(URL, {headers:{'X-Auth-Token': '3fafad61defb4eb6bd5574ee286e9b8a'}})
      .then(res=>res.json())
      .then(res=>{
        console.log(res)
      })

  }

  render() {
    return (
      <div className="App">
        <header className="App-header">
          <img src={logo} className="App-logo" alt="logo" />
          <h1 className="App-title">Welcome to React</h1>
        </header>
        <p className="App-intro">
          To get started, edit <code>src/App.js</code> and save to reload.
        </p>
      </div>
    );
  }
}

export default App;
