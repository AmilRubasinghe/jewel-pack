 <template>
  <div>
    <section>
      <footer>
        <div class="footer">
          <v-container>
            <v-layout row wrap justify-center class="my-5">
              <v-flex xs10 sm3>
                <v-card class="elevation-0 transparent">
                  <v-card-title primary-title class="layout justify-center">
                    <div class="headline">Company info</div>
                  </v-card-title>
                  <v-card-text>
                    <ul>
                      <li>
                        <a href>Gem boxes</a>
                      </li>

                      <li>
                        <a href>Jewellery boxes</a>
                      </li>

                      <li>
                        <a href>store locator</a>
                      </li>
                      <li>
                        <a href>Your accounts</a>
                      </li>

                      <li>
                        <a href>Take your order</a>
                      </li>

                      <li>
                        <a href>Email sign In</a>
                      </li>
                      <li>
                        <a href>Return & refunds</a>
                      </li>
                    </ul>
                  </v-card-text>
                </v-card>
              </v-flex>
              <v-flex xs10 sm3 offset-sm1>
                <v-card class="elevation-0 transparent">
                  <v-card-title primary-title class="layout justify-center">
                    <div class="headline">Contact us</div>
                  </v-card-title>

                  <v-list class="transparent">
                    <v-list-tile>
                      <v-list-tile-action>
                        <v-icon class="blue--text text--lighten-2">phone</v-icon>
                      </v-list-tile-action>
                      <v-list-tile-content>
                        <v-list-tile-title>+9477-000-0000</v-list-tile-title>
                      </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile>
                      <v-list-tile-action>
                        <v-icon class="blue--text text--lighten-2">place</v-icon>
                      </v-list-tile-action>
                      <v-list-tile-content>
                        <v-list-tile-title>Colombo, Sri Lanka</v-list-tile-title>
                      </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile>
                      <v-list-tile-action>
                        <v-icon class="blue--text text--lighten-2">email</v-icon>
                      </v-list-tile-action>
                      <v-list-tile-content>
                        <v-list-tile-title>jewelPack@example.com</v-list-tile-title>
                      </v-list-tile-content>
                    </v-list-tile>

                    <v-list-tile>
                      <v-list-tile-action>
                        <v-icon class="blue--text text--lighten-2">fb</v-icon>
                      </v-list-tile-action>
                      <v-list-tile-content>
                        <v-list-tile-title>jewelpackcompany</v-list-tile-title>
                      </v-list-tile-content>
                    </v-list-tile>
                  </v-list>
                </v-card>
              </v-flex>

              <v-flex xs10 sm3 payment>
                <v-card class="elevation-0 transparent">
                  <v-card-title primary-title class="layout justify-center">
                    <div class="headline">Payment Method</div>
                  </v-card-title>
                  <v-card-text>
                    <i class="fab fa-cc-visa fa-w-18 fa-3x"></i>
                    <i class="fab fa-cc-mastercard fa-w-18 fa-3x"></i>
                    <i class="fab fa-cc-amex fa-w-18 fa-3x"></i>
                    <a href="https://www.payhere.lk" target="_blank">
                      <img
                        src="https://www.payhere.lk/downloads/images/pay_with_payhere.png"
                        alt="Pay with PayHere"
                        width="200"
                      >
                    </a>
                  </v-card-text>
                </v-card>
              </v-flex>
            </v-layout>
            <v-layout row wrap justify-center class="row-my">
              <div class="copy-right-footer">
                <div class="container">
                  <div class="row-copy-center">
                    <div class="travel-copyright">
                      <p>
                        <center>Copy right &copy; 2019 web desing Srilanka</center>
                      </p>
                      <p>
                        All rights design reserved design by
                        <span>T E A M SPATA</span>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </v-layout>
          </v-container>
        </div>
      </footer>
    </section>
  </div>
</template>


      <style>
.v-card__text ul li {
  padding: 2.5px;
  border-bottom: 1px dotted #47505b;
}

.v-card__text ul {
  list-style-type: none;
}

.container.grid-list-xl {
  background-color: #393b45;
}

.footer {
  background-color: #393b45;
}

.layout.my-5.row.wrap.justify-center {
  background-color: #393b45;
}

.flex.xs10.sm3.payment {
  padding-left: 50px;
}

i.fab.fa-cc-visa {
  size: 5 x;
  color: #7487e3;
  padding: 5px;
}

i.fab.fa-cc-mastercard.fa-w-18.fa-3x {
  color: #7487e3;
  padding: 5px;
}

i.fab.fa-cc-amex.fa-w-18.fa-3x {
  color: #7487e3;
  padding: 5px;
}

.travel-copyright p {
  color: #a6a6a6;
  text-align: center;
  margin: 0;
  font-size: 12px;
}

.travel-copyright p span {
  color: rgb(218, 26, 26);
}

.copy-right-footer {
  border-top: 1px solid;
  border-color: rgba(221, 221, 221, 0.12);
}
</style>