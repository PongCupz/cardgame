<template>
  <div id="main">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-4 col-xlg-3 col-md-5">
          <div class="card">
              <div class="card-body el-card-content">
                  <h3 class="box-title">Click</h3>
                  <h6 class="box-content">{{ clickcount }}</h6>
                  <h3 class="box-title">My Best</h3>
                  <h6 class="box-content">{{ mybest }}</h6>
                  <h3 class="box-title">Global Best </h3>
                  <h6 class="box-content" id="globalbest">{{ globalbest }}</h6>
                  <br>
                  <button type="button" class="btn btn-block btn-lg btn-success" @click="newGame()">New Game</button>
              </div>
          </div>
        </div>
        <div class="col-lg-8 col-xlg-9 col-md-7">
          <div class="card">
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active" id="home" role="tabpanel">
                  <div class="card-body card-body-game">
                    <div class="sl-item">
                      <div class="form-group">
                        <div>
                          <div class="row">
                            <!-- column -->
                            <div class="col-3">
                                <!-- Card -->
                                <div class="card">
                                    <div class="card-body card-game card-close" id="card-0"  @click="click(0)">
                                        <p class="card-text"></p>
                                    </div>
                                </div>
                                <!-- Card -->
                            </div>
                            <!-- column -->
                            <!-- column -->
                            <div class="col-3">
                                <!-- Card -->
                                <div class="card">
                                    <div class="card-body card-game card-close" id="card-1"  @click="click(1)">
                                        <p class="card-text"></p>
                                    </div>
                                </div>
                                <!-- Card -->
                            </div>
                            <!-- column -->
                            <!-- column -->
                            <div class="col-3">
                                <!-- Card -->
                                <div class="card">
                                    <div class="card-body card-game card-close" id="card-2"  @click="click(2)">
                                        <p class="card-text"></p>
                                    </div>
                                </div>
                                <!-- Card -->
                            </div>
                            <!-- column -->
                            <!-- column -->
                            <div class="col-3 img-responsive">
                                <!-- Card -->
                                <div class="card">
                                    <div class="card-body card-game card-close" id="card-3"  @click="click(3)">
                                        <p class="card-text"></p>
                                    </div>
                                </div>
                                <!-- Card -->
                            </div>
                            <!-- column -->
                          </div>
                          <div class="row">
                            <!-- column -->
                            <div class="col-3">
                                <!-- Card -->
                                <div class="card">
                                    <div class="card-body card-game card-close" id="card-4"  @click="click(4)">
                                        <p class="card-text"></p>
                                    </div>
                                </div>
                                <!-- Card -->
                            </div>
                            <!-- column -->
                            <!-- column -->
                            <div class="col-3">
                                <!-- Card -->
                                <div class="card">
                                    <div class="card-body card-game card-close" id="card-5"  @click="click(5)">
                                        <p class="card-text"></p>
                                    </div>
                                </div>
                                <!-- Card -->
                            </div>
                            <!-- column -->
                            <!-- column -->
                            <div class="col-3">
                                <!-- Card -->
                                <div class="card">
                                    <div class="card-body card-game card-close" id="card-6"  @click="click(6)">
                                        <p class="card-text"></p>
                                    </div>
                                </div>
                                <!-- Card -->
                            </div>
                            <!-- column -->
                            <!-- column -->
                            <div class="col-3 img-responsive">
                                <!-- Card -->
                                <div class="card">
                                    <div class="card-body card-game card-close" id="card-7"  @click="click(7)">
                                        <p class="card-text"></p>
                                    </div>
                                </div>
                                <!-- Card -->
                            </div>
                            <!-- column -->
                          </div>
                          <div class="row">
                            <!-- column -->
                            <div class="col-3">
                                <!-- Card -->
                                <div class="card">
                                    <div class="card-body card-game card-close" id="card-8"  @click="click(8)">
                                        <p class="card-text"></p>
                                    </div>
                                </div>
                                <!-- Card -->
                            </div>
                            <!-- column -->
                            <!-- column -->
                            <div class="col-3">
                                <!-- Card -->
                                <div class="card">
                                    <div class="card-body card-game card-close" id="card-9"  @click="click(9)">
                                        <p class="card-text"></p>
                                    </div>
                                </div>
                                <!-- Card -->
                            </div>
                            <!-- column -->
                            <!-- column -->
                            <div class="col-3">
                                <!-- Card -->
                                <div class="card">
                                    <div class="card-body card-game card-close" id="card-10"  @click="click(10)">
                                        <p class="card-text"></p>
                                    </div>
                                </div>
                                <!-- Card -->
                            </div>
                            <!-- column -->
                            <!-- column -->
                            <div class="col-3 img-responsive">
                                <!-- Card -->
                                <div class="card">
                                    <div class="card-body card-game card-close" id="card-11"  @click="click(11)">
                                        <p class="card-text"></p>
                                    </div>
                                </div>
                                <!-- Card -->
                            </div>
                            <!-- column -->
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
// import amqp from 'amqplib/callback_api'
export default {
  name: 'main',
  data () {
    return {
      clickcount: 0,
      mybest: 0,
      globalbest: 0
    }
  },
  mounted () {
    if (this.$cookie.get('userid') == null && this.$cookie.get('gameid') == null) {
      axios.post(process.env.ROOT_API + '/users').then(response => {
        this.$cookie.set('userid', response.data.user_id, 1)
        this.$cookie.set('gameid', response.data.id, 1)
        this.render(response.data.data)
        this.globalbest = response.data.global_best_score
      })
    } else {
      axios.get(process.env.ROOT_API + '/cards/' + this.$cookie.get('gameid')).then(response => {
        this.$cookie.set('userid', response.data.user_id, 1)
        this.$cookie.set('gameid', response.data.id, 1)
        this.render(response.data.data)
        this.clickcount = response.data.click
        this.mybest = response.data.best_score
        this.globalbest = response.data.global_best_score
      })
    }

    this.$mqtt.subscribe('test')
    this.$mqtt.on('message', function (topic, payload) {
      document.getElementById('globalbest').innerHTML = [payload].join('')
    })
  },
  methods: {
    loadData () {
    },
    click (card) {
      var data = { 'picked': card }
      axios.patch(process.env.ROOT_API + '/cards/' + this.$cookie.get('gameid'), data).then(response => {
        this.render(response.data.data)
        this.clickcount = response.data.click
        this.mybest = response.data.best_score
        document.getElementById('globalbest').innerHTML = response.data.global_best_score
      })
    },
    render (data) {
      data.forEach(function (value, key) {
        if (value !== -1) {
          document.getElementById('card-' + key).classList.remove('card-close')
          document.getElementById('card-' + key).classList.add('card-' + value)
        } else {
          document.getElementById('card-' + key).classList.add('card-close')
          for (var i = 1; i <= 6; i++) {
            document.getElementById('card-' + key).classList.remove('card-' + i)
          }
        }
      })
    },
    newGame () {
      var data = { 'user_id': this.$cookie.get('userid') }
      axios.post(process.env.ROOT_API + '/cards/new', data).then(response => {
        this.$cookie.set('gameid', response.data.id, 1)
        this.render(response.data.data)
        this.clickcount = 0
        this.mybest = response.data.best_score
        document.getElementById('globalbest').innerHTML = response.data.global_best_score
      })
    }
  }
}
</script>

<style scoped></style>
