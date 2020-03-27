import ReactDOM from 'react-dom'
import SignIn from './src/login.js'

require('./../../bootstrap')

window.React = require('react')

if (document.getElementById('root')) {
  ReactDOM.render(<SignIn />, document.getElementById('root'))
}
