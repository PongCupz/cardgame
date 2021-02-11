'use strict'
const merge = require('webpack-merge')
const prodEnv = require('./prod.env')

module.exports = merge(prodEnv, {
  NODE_ENV: '"development"',
  ROOT_API: '"http://localhost:8080"',
  ROOT_WS: '"ws://localhost:15675/ws"',
  GG_KEY: '"AIzaSyDdEEPcJpCni349iXn4W3z6HIC5N480Q0k"'
})
