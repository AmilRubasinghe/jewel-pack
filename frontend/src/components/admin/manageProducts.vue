

<template>
  <div>
    <navDrawer></navDrawer>
    <br />

    <div class="container" v-bind:style="{ background: '#B0BEC5'}">
      <v-dialog v-model="dialog" max-width="900">
        <v-card>
          <v-card-title style="background-color:#eabf00;  ">
            <span class="headline">
              <p class="headline font-weight-bold" style="color:#212121; ">Upload Form</p>
            </span>
          </v-card-title>

          <v-card-text>
            <v-container grid-list-md text-md-center fluid fill-height>
              <v-layout column>
                <v-flex d-flex>
                  <v-layout row wrap>
                    <v-flex md6 sm12 lg6 xs12 d-flex>
                      <v-text-field
                        v-model="newProduct.size"
                        v-validate="'required'"
                        :error-messages="errors.collect('size')"
                        label="Size"
                        data-vv-name="Size"
                        required
                      />
                    </v-flex>

                    <v-flex md6 sm12 lg6 xs12 d-flex>
                      <v-select
                        label="Category"
                        :items="category"
                        item-text="CName"
                        item-value="CID"
                        v-model="newProduct.cid"
                        outline
                        menu-props
                      ></v-select>
                    </v-flex>
                  </v-layout>
                </v-flex>

                <v-flex d-flex>
                  <v-layout row wrap>
                    <v-flex md6 sm12 lg6 xs12 d-flex>
                      <v-text-field
                        v-model="newProduct.colour"
                        v-validate="'required'"
                        :error-messages="errors.collect('colour')"
                        label="Colour"
                        data-vv-name="Colour"
                        required
                      />
                    </v-flex>

                    <v-flex md6 sm12 lg6 xs12 d-flex>
                      <v-text-field
                        input-type="number"
                        v-model="newProduct.price"
                        v-validate="'required'"
                        :error-messages="errors.collect('price')"
                        label="Price"
                        data-vv-name="Price"
                        required
                        type="number"
                        onkeydown="javascript: return event.keyCode == 69 ? false : true"
                      />
                    </v-flex>
                  </v-layout>
                </v-flex>

                <v-flex md8 sm3 lg8 xs3 d-flex>
                  <v-text-field
                    label="Details"
                    v-model="newProduct.details"
                    v-validate="'required'"
                    :error-messages="errors.collect('text box')"
                    single-line
                    solo
                    required
                  />
                </v-flex>

                <v-flex d-flex>
                  <v-layout row wrap>
                    <v-flex md6 sm12 lg6 xs12 d-flex>
                      <v-combobox
                        v-model="newProduct.shipMethod"
                        :items=" ShippingMethodItems"
                        item-text="shipMethod"
                        item-value="shipId"
                        label="Shipping Method"
                        chips
                        clearable
                        multiple
                        outline
                        solo
                      >
                        <template v-slot:selection="{ attrs,item , select, selected }">
                          <v-chip
                            v-bind="attrs"
                            :input-value="selected"
                            close
                            @click="selectShip(item)"
                            @input="remove(item)"
                          >
                            <strong>{{item.shipMethod}}</strong>
                            &nbsp;
                          </v-chip>
                        </template>
                      </v-combobox>
                    </v-flex>

                    <v-flex md6 sm12 lg6 xs12 d-flex>
                      <v-text-field
                        input-type="number"
                        v-model="newProduct.slashedPrice"
                        v-validate="'required'"
                        :error-messages="errors.collect('slashedPrice')"
                        label="Slashed Price"
                        data-vv-name="slashedPrice"
                        required
                        type="number"
                        onkeydown="javascript: return event.keyCode == 69 ? false : true"
                      />
                    </v-flex>
                  </v-layout>
                </v-flex>
                <v-flex md3 sm12 lg3 xs12 d-flex>
                  <v-checkbox
                    v-model="newProduct.border"
                    v-validate="'required'"
                    :error-messages="errors.collect('checkbox')"
                    value="1"
                    label="Gold border"
                    data-vv-name="checkbox"
                    type="checkbox"
                    required
                  ></v-checkbox>
                </v-flex>

                <v-flex d-flex>
                  <v-layout row wrap justify-center>
                    <v-flex xs6 sm6 md3 lg3 d-flex>
                      <v-card flat ripple hover max-height="300" max-width="250">
                        <form enctype="multipart/form-data">
                          <div class="text-xs-center">
                            <label class="button">
                              <input
                                id="photoA"
                                type="file"
                                ref="file-1"
                                accept="image/*"
                                @change="addFile('photoA', $event)"
                                style="display:none"
                              />
                              <!--<input
                                type="file"
                                ref="file"
                                @change="selectFile"
                                style="display:none"
                              />-->
                              <v-icon outline large>cloud_upload</v-icon>
                              <p
                                class="subtitle-1 font-weight-medium"
                                style="color:#616161;"
                              >Upload photo</p>
                              <span v-if="photoA" class="file-name">
                                <p
                                  class="subtitle-1 font-weight-medium"
                                  style="color:#eabf00; align:center;"
                                >{{photoA.name}}</p>
                              </span>
                            </label>
                          </div>
                        </form>
                      </v-card>
                    </v-flex>
                    <!-- <v-flex xs9 sm9 md7 lg7  d-flex>
                     <v-card
                flat
                color="#B0BEC5"
                @click="$refs.file.click()"
                ripple
                hover
                max-height="300"
                
                max-width="600"
              >
              
  
<vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions" v-on:vdropzone-sending="addProduct" >
  <v-icon outline large>cloud_upload</v-icon>
 <h4>Upload photo</h4>
</vue-dropzone>

</v-card>
                    </v-flex>-->
                    <v-flex xs6 sm6 md3 lg3 d-flex>
                      <v-card flat ripple hover max-height="300" max-width="250">
                        <form enctype="multipart/form-data">
                          <div class="text-xs-center">
                            <label class="button">
                              <input
                                id="photoA"
                                type="file"
                                ref="file"
                                accept="image/*"
                                @change="addFile('photoB', $event)"
                                style="display:none"
                              />
                              <!--<input
                                type="file"
                                ref="file"
                                @change="selectFile"
                                style="display:none"
                              />-->
                              <v-icon outline large>cloud_upload</v-icon>
                              <p
                                class="subtitle-1 font-weight-medium"
                                style="color:#616161;"
                              >Upload photo</p>
                              <span v-if="photoB" class="file-name">
                                <p
                                  class="subtitle-1 font-weight-medium"
                                  style="color:#eabf00; align:center;"
                                >{{photoB.name}}</p>
                              </span>
                            </label>
                          </div>
                        </form>
                      </v-card>
                    </v-flex>

                    <v-flex xs6 sm6 md3 lg3 d-flex>
                      <v-card flat ripple hover max-height="300" max-width="250">
                        <form enctype="multipart/form-data">
                          <div class="text-xs-center">
                            <label class="button">
                              <input
                                id="photoA"
                                type="file"
                                ref="file"
                                accept="image/*"
                                @change="addFile('photoC', $event)"
                                style="display:none"
                              />
                              <!-- <input
                                type="file"
                                ref="file"
                                @change="selectFile"
                                style="display:none"
                              />-->
                              <v-icon outline large>cloud_upload</v-icon>
                              <p
                                class="subtitle-1 font-weight-medium"
                                style="color:#616161;"
                              >Upload photo</p>
                              <span v-if="photoC" class="file-name">
                                <p
                                  class="subtitle-1 font-weight-medium"
                                  style="color:#eabf00; align:center;"
                                >{{photoC.name}}</p>
                              </span>
                            </label>
                          </div>
                        </form>
                      </v-card>
                    </v-flex>

                    <v-flex xs6 sm6 md3 lg3 d-flex>
                      <v-card flat ripple hover max-height="300" max-width="250">
                        <form enctype="multipart/form-data">
                          <div class="text-xs-center">
                            <label class="button">
                              <input
                                id="photoA"
                                type="file"
                                ref="file"
                                accept="image/*"
                                @change="addFile('photoD', $event)"
                                style="display:none"
                              />
                              <!-- <input
                                type="file"
                                ref="file"
                                @change="selectFile"
                                style="display:none"
                              />-->
                              <v-icon outline large>cloud_upload</v-icon>
                              <p
                                class="subtitle-1 font-weight-medium"
                                style="color:#616161;"
                              >Upload photo</p>
                              <span v-if="photoD" class="file-name">
                                <p
                                  class="subtitle-1 font-weight-medium"
                                  style="color:#eabf00; align:center;"
                                >{{photoD.name}}</p>
                              </span>
                            </label>
                          </div>
                        </form>
                      </v-card>
                    </v-flex>
                  </v-layout>
                </v-flex>
              </v-layout>
            </v-container>
          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-container grid-list-md text-md-center fluid fill-height>
              <v-layout row wrap justify-end>
                <v-flex xs4 sm4 md2 lg2 d-flex>
                  <v-btn outline color="#eabf00" @click="clear">clear</v-btn>
                </v-flex>

                <v-flex xs4 sm4 md2 lg2 d-flex>
                  <v-btn color="#eabf00" @click="dialog = false">Close</v-btn>
                </v-flex>

                <v-flex xs4 sm4 md2 lg2 d-flex>
                  <v-btn color="#eabf00" @click="addProduct">Save</v-btn>
                </v-flex>
              </v-layout>
            </v-container>
          </v-card-actions>
        </v-card>
      </v-dialog>

      <v-dialog v-model="showModal" max-width="900">
        <v-card>
            <v-card-title style="background-color:#eabf00;  ">
            <span class="headline">
              <p class="headline font-weight-bold" style="color:#212121; ">Edit Product</p>
            </span>
          </v-card-title>

         
          <v-card-text>
            <v-container grid-list-md text-md-center fluid fill-height>
              <v-layout column>
                <v-flex d-flex>
                  <v-layout row wrap>
                    <v-flex md6 sm12 lg6 xs12 d-flex>
                      <v-text-field v-model="editedItem.PID" label="PID" disabled />
                    </v-flex>

                    <v-flex md6 sm12 lg6 xs12 d-flex>
                      <v-select
                        label="Category"
                        :items="category"
                        item-text="CName"
                        item-value="CID"
                        v-model="editedItem.CID"
                        outline
                        menu-props
                      ></v-select>
                    </v-flex>
                  </v-layout>
                </v-flex>

                <v-flex d-flex>
                  <v-layout row wrap>
                    <v-flex md6 sm12 lg6 xs12 d-flex>
                      <v-text-field label="Size" v-model="editedItem.Size"></v-text-field>
                    </v-flex>

                    <v-flex md6 sm12 lg6 xs12 d-flex>
                      <v-text-field label="Colour" v-model="editedItem.Colour"></v-text-field>
                    </v-flex>
                  </v-layout>
                </v-flex>

                <v-flex d-flex>
                  <v-layout row wrap>
                    <v-flex md6 sm12 lg6 xs12 d-flex>
                      <v-text-field
                        v-model="editedItem.Price"
                        label="Price"
                        type="number"
                        onkeydown="javascript: return event.keyCode == 69 ? false : true"
                      ></v-text-field>
                    </v-flex>

                    <v-flex md6 sm12 lg6 xs12 d-flex>
                      <v-text-field v-model="editedItem.unitWeight" label="unit Weight" />
                    </v-flex>
                  </v-layout>
                </v-flex>

                <v-flex d-flex>
                  <v-layout row wrap>
                    <v-flex md3 sm12 lg3 xs12 d-flex>
                      <v-checkbox v-model="editedItem.border" label="Gold border"></v-checkbox>
                    </v-flex>

                    <v-flex md9 sm12 lg9 xs12 d-flex>
                      <v-text-field v-model="editedItem.description" label="Details" />
                    </v-flex>
                  </v-layout>
                </v-flex>

                <v-flex d-flex>
                  <v-layout row wrap>
                    <v-flex md6 sm12 lg6 xs12 d-flex>
                      <v-select
                        label="Shipping Method"
                        :items=" ShippingMethodItems"
                        item-text="shipMethod"
                        item-value="shipId"
                        v-model="editedItem.shipId"
                        outline
                        menu-props
                      ></v-select>
                    </v-flex>

                    <v-flex md9 sm12 lg9 xs12 d-flex></v-flex>
                  </v-layout>
                </v-flex>

                <v-flex d-flex>
                  <v-layout row wrap>
                    <v-flex xs6 sm6 md3 lg3 d-flex>
                      <v-card flat ripple hover max-height="300" max-width="250">
                         <v-hover v-slot:default="{ hover }">
                        <v-img max-height="150" max-width="250" :src="editedItem.Image1">
                           <v-expand-transition>
                <div
                  v-if="hover"
                  class="d-flex transition-fast-in-fast-out black darken-1 v-card--reveal display-1 white--text"
                  style="height: 40%;"
                >
                  <v-btn
                    color="transparent"
                    class="white--text"
                    large
                    :ripple="false"
                    @click="deletePhoto"
                  >Delete</v-btn>
                </div>
              </v-expand-transition>

                        </v-img>
                         </v-hover>
                        <form enctype="multipart/form-data">
                          <div class="text-xs-center">
                            <label class="button">
                              <input
                                id="photoA"
                                type="file"
                                ref="file"
                                accept="image/*"
                                @change="addFile('photoA', $event)"
                                style="display:none"
                              />
                              <!-- <input
                                type="file"
                                ref="file"
                                @change="selectFile"
                                style="display:none"
                              />-->
                              <v-icon outline large>cloud_upload</v-icon>
                              <p
                                class="subtitle-1 font-weight-medium"
                                style="color:#616161;"
                              >Upload photo</p>
                              <span v-if="photoA" class="file-name">
                                <p
                                  class="subtitle-1 font-weight-medium"
                                  style="color:#eabf00; align:center;"
                                >{{photoA.name}}</p>
                              </span>
                            </label>
                          </div>
                        </form>
                      </v-card>
                    </v-flex>

                    <v-flex xs6 sm6 md3 lg3 d-flex>
                      <v-card flat ripple hover max-height="300" max-width="250">
                        <v-img max-height="150" max-width="250" :src="editedItem.Image2"></v-img>
                        <form enctype="multipart/form-data">
                          <div class="text-xs-center">
                            <label class="button">
                              <input
                                id="photoA"
                                type="file"
                                ref="file"
                                accept="image/*"
                                @change="addFile('photoB', $event)"
                                style="display:none"
                              />
                              <!-- <input
                                type="file"
                                ref="file"
                                @change="selectFile"
                                style="display:none"
                              />-->
                              <v-icon outline large>cloud_upload</v-icon>
                              <p
                                class="subtitle-1 font-weight-medium"
                                style="color:#616161;"
                              >Upload photo</p>
                              <span v-if="photoB" class="file-name">
                                <p
                                  class="subtitle-1 font-weight-medium"
                                  style="color:#eabf00; align:center;"
                                >{{photoB.name}}</p>
                              </span>
                            </label>
                          </div>
                        </form>
                      </v-card>
                    </v-flex>

                    <v-flex xs6 sm6 md3 lg3 d-flex>
                      <v-card flat ripple hover max-height="300" max-width="250">
                        <v-img max-height="150" max-width="250" :src="editedItem.Image3"></v-img>
                        <form enctype="multipart/form-data">
                          <div class="text-xs-center">
                            <label class="button">
                              <input
                                id="photoA"
                                type="file"
                                ref="file"
                                accept="image/*"
                                @change="addFile('photoC', $event)"
                                style="display:none"
                              />
                              <!-- <input
                                type="file"
                                ref="file"
                                @change="selectFile"
                                style="display:none"
                              />-->
                              <v-icon outline large>cloud_upload</v-icon>
                              <p
                                class="subtitle-1 font-weight-medium"
                                style="color:#616161;"
                              >Upload photo</p>
                              <span v-if="photoC" class="file-name">
                                <p
                                  class="subtitle-1 font-weight-medium"
                                  style="color:#eabf00; align:center;"
                                >{{photoC.name}}</p>
                              </span>
                            </label>
                          </div>
                        </form>
                      </v-card>
                    </v-flex>

                    <v-flex xs6 sm6 md3 lg3 d-flex>
                      <v-card flat ripple hover max-height="300" max-width="250">
                        <v-img max-height="150" max-width="250" :src="editedItem.Image4"></v-img>
                        <form enctype="multipart/form-data">
                          <div class="text-xs-center">
                            <label class="button">
                              <input
                                id="photoA"
                                type="file"
                                ref="file"
                                accept="image/*"
                                @change="addFile('photoD', $event)"
                                style="display:none"
                              />
                              <!-- <input
                                type="file"
                                ref="file"
                                @change="selectFile"
                                style="display:none"
                              />-->
                              <v-icon outline large>cloud_upload</v-icon>
                              <p
                                class="subtitle-1 font-weight-medium"
                                style="color:#616161;"
                              >Upload photo</p>
                              <span v-if="photoD" class="file-name">
                                <p
                                  class="subtitle-1 font-weight-medium"
                                  style="color:#eabf00; align:center;"
                                >{{photoD.name}}</p>
                              </span>
                            </label>
                          </div>
                        </form>
                      </v-card>
                    </v-flex>
                  </v-layout>
                </v-flex>
              </v-layout>
            </v-container>
          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-container grid-list-md text-md-center fluid fill-height>
              <v-layout justify-end row wrap>
                <v-flex md3 sm4 lg3 xs4 d-flex>
                  <v-btn color="primary" @click="close">Cancel</v-btn>
                </v-flex>

                <v-flex md3 sm4 lg3 xs4 d-flex>
                  <v-btn color="primary" @click="editSave">Save</v-btn>
                </v-flex>
              </v-layout>
            </v-container>
          </v-card-actions>
        </v-card>
      </v-dialog>

      <!--new quantity view----->

      <v-dialog v-model="showQuantity" max-width="700">
        <v-card>
          <v-card-title>
            <span class="headline">Add Quantity</span>
          </v-card-title>

          <v-card-text>
            <v-container grid-list-md text-md-center fluid fill-height>
              <v-layout column>
                <v-flex d-flex>
                  <v-layout row wrap>
                    <v-flex md6 sm12 lg6 xs12 d-flex>
                      <v-select
                        label="Lot"
                        :items="lotItem"
                        item-text="lotquantity"
                        item-value="lid"
                        v-model="newLotQuantity.lot"
                        type="number"
                        onkeydown="javascript: return event.keyCode == 69 ? false : true"
                        outline
                        menu-props
                      ></v-select>
                    </v-flex>

                    <v-flex md6 sm12 lg6 xs12 d-flex>
                      <v-text-field
                        v-model="newLotQuantity.quantity"
                        v-validate="'required'"
                        :error-messages="errors.collect('quatity')"
                        label="Quantity"
                        data-vv-name="quantity"
                        required
                        type="number"
                        onkeydown="javascript: return event.keyCode == 69 ? false : true"
                      />
                    </v-flex>
                  </v-layout>
                </v-flex>
                <v-layout row wrap>
                  <v-flex md4 sm12 lg4 xs12 d-flex offset-md3 offset-xs1 offset-lg3>
                    <v-text-field v-model="TotallotQuantity" label="Total Quntity" readonly />
                  </v-flex>
                </v-layout>
              </v-layout>
            </v-container>
          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-container grid-list-md text-md-center fluid fill-height>
              <v-layout row wrap>
                <v-flex d-flex>
                  <v-btn outline color="primary" @click="clearQuntity">clear</v-btn>
                </v-flex>

                <v-flex d-flex>
                  <v-btn color="primary" @click="close">Cancel</v-btn>
                </v-flex>
                <v-flex d-flex>
                  <v-btn color="primary" @click="SaveQuntity">Add to Lot</v-btn>
                </v-flex>
                <v-flex d-flex>
                  <v-btn color="blue darken-1" @click="DeleteQuntity">Delete to Lot</v-btn>
                </v-flex>
              </v-layout>
            </v-container>
          </v-card-actions>
        </v-card>
      </v-dialog>

      <div>
        <v-toolbar flat color="white">
          <v-toolbar-title>{{table_title}}</v-toolbar-title>
          <v-spacer></v-spacer>

          <v-text-field
            v-model="search"
            append-icon="search"
            label="Search"
            single-line
            hide-details
          ></v-text-field>

          <v-btn fab dark color="blue" @click="openDialogProduct">
            <v-icon dark>add</v-icon>
          </v-btn>

          <v-btn fab dark color="blue" @click=" productItems ">
            <v-icon medium dark>refresh</v-icon>
          </v-btn>

          <v-btn v-if="!deletedItem" @click="getDeletedProducts">
            <v-icon large color="blue">delete_sweep</v-icon>Deleted products
          </v-btn>

          <v-btn v-if="deletedItem" @click="productItems">
            <v-icon large color="blue">playlist_add_check</v-icon>Active products
          </v-btn>
        </v-toolbar>

        <v-data-table
          v-model="selected"
          :headers="headers"
          :items="products"
          :search="search"
          :pagination.sync="pagination"
          select-all
          item-key="ID"
          class="elevation-1"
        >
          <template v-slot:headers="props">
            <tr align="left">
              <th
                v-for="header in props.headers"
                :key="header.text"
                :class="['column sortable', pagination.descending ? 'desc' : 'asc', header.value === pagination.sortBy ? 'active' : '']"
                @click="changeSort(header.value)"
              >
                <v-icon small>arrow_upward</v-icon>
                {{ header.text }}
              </th>
            </tr>
          </template>
          <template v-slot:no-data>
            <v-alert :value="true" color="error" icon="warning">Sorry, nothing to display here :(</v-alert>
          </template>
          <template v-slot:items="props">
            <tr :active="props.selected" @click="props.selected = !props.selected">
              <td class="text-xs-center">{{ props.item.PID }}</td>
              <td class="text-xs-center">{{ props.item.Size }}</td>
              <td class="text-xs-center">{{ props.item.CID }}</td>
              <td class="text-xs-left">{{ props.item.Image1}}</td>
              <td class="text-xs-left">
                <v-img :src="props.item.Image1"></v-img>
              </td>
              <td class="text-xs-left">
                <v-img :src="props.item.Image2"></v-img>
              </td>
              <td class="text-xs-left">
                <v-img :src="props.item.Image3"></v-img>
              </td>
              <td class="text-xs-left">
                <v-img :src="props.item.Image4"></v-img>
              </td>
              <td class="text-xs-center">{{ props.item.Quantity}}</td>
              <td class="text-xs-center">{{ props.item.Colour }}</td>
              <td class="text-xs-center">{{ props.item.Price }}</td>
              <td class="text-xs-center">{{ props.item.slashedPrice }}</td>

              <td class="text-xs-left">{{ props.item.description }}</td>
              <td class="text-xs-center">{{ props.item.border }}</td>
              <td class="text-xs-center">{{ props.item.shipMethod }}</td>

              <td class="justify-center layout px-0">
                <v-icon
                  v-if="!deletedItem"
                  color="blue-grey lighten-1"
                  medium
                  class="mr-2"
                  @click="AddQuantity(props.item)"
                >add_box</v-icon>

                <v-icon
                  color="deep-purple darken-1"
                  medium
                  class="mr-2"
                  @click="editItem(props.item)"
                >edit</v-icon>
                <v-icon
                  v-if="!deletedItem"
                  color="red"
                  medium
                  @click="deleteItem(props.item)"
                >delete</v-icon>
                <v-icon
                  v-if="deletedItem"
                  color="green"
                  medium
                  @click="restoreItem(props.item)"
                >restore_from_trash</v-icon>
              </td>
            </tr>
          </template>
        </v-data-table>
      </div>
    </div>
  </div>
</template>






<script>
import axios from "axios";
import navDrawer from "../admin/navDrawer.vue";
import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";
export default {
  name: "app",

  data() {
    return {
      /*dropzoneOptions: {
          url: 'https://httpbin.org/post',
          thumbnailWidth: 150,
          maxFilesize: 0.5,
          headers: { "My-Awesome-Header": "header value" },
          addRemoveLinks: true,
        dictDefaultMessage: "<i class='fa fa-cloud-upload'></i>UPLOAD HERE",

     
          
      },*/

      photoA: undefined,
      photoB: undefined,
      photoC: undefined,
      photoD: undefined,

      dialog: false,
      showModal: false,
      showQuantity: false,
      editedIndex: -1,
      imageName1: "",
      imageUrl: "",
      imageFile: "",
      LotQuantity: "",

      model: [],

      file: "",

      model: null,
      multiple: false,
      mandatory: false,
      showArrows: true,
      prevIcon: false,
      nextIcon: false,
      centerActive: false,

      editedItem: {
        PID: 0,
        Size: 0,
        CID: "",
        Image1: "",
        Quantity: "",
        Colour: "",
        Price: "",
        unitWeight: "",
        description: "",
        border: 0
      },

      quantity: "",
      details: "",
      price: "",
      size: "",
      colour: "",
      lot: "",

      newProduct: {
        quantity: "",
        details: "",
        price: "",
        size: "",
        colour: "",
        border: 0,
        image1: "",
        cid: "",
        slashedPrice: "",
        shipMethod: []
      },

      newLotQuantity: {
        lot: "",
        quantity: ""
      },

      sizes: ["1x1", "2x2", "3x3", "4x4", "5x5"],

      category: [],
      lotItem: [],
      ShippingMethodItems: [],

      colours: ["White", "Black"],

      defaultItem: {
        imageID: 0,
        // size: 0,
        image1: "",
        ext: "",
        deleteURL: ""
      },

      search: "",
      products: [],
      pagination: {
        sortBy: "PID"
      },
      selected: [],
      deletedItem: false,
      table_title: "Product Items",

      headers: [
        { text: "PID", value: "PID" },
        { text: "Size", value: "Size" },
        { text: "Cat. ID", value: "CID" },
        { text: "Image", value: "Image" },
        { text: "Preview 1", value: "preview 1" },
        { text: "Preview 2", value: "preview 2" },
        { text: "Preview 3", value: "preview 3" },
        { text: "Preview 4", value: "preview 4" },
        { text: "Quantity", value: "Quantity" },
        { text: "Colour", value: "Colour" },
        { text: "Price", value: "Price" },
        { text: "Slashed Price", value: "slashedPrice" },

        { text: "Details", value: "description" },
        { text: "Border", value: "border" },

        { text: "Action", value: "action" }
      ]
    };
  },

  mounted() {
    this.productItems();
    this.catItems();
    this.lotItems();
    this.methodItems();
  },

  components: {
    vueDropzone: vue2Dropzone,

    navDrawer
  },

  computed: {
    pages() {
      if (
        this.pagination.rowsPerPage == null ||
        this.pagination.totalItems == null
      )
        return 0;

      return Math.ceil(
        this.pagination.totalItems / this.pagination.rowsPerPage
      );
    },

    TotallotQuantity: function() {
      if (this.newLotQuantity.lot) {
        let obj = this.lotItem.find(
          item => item.lid === this.newLotQuantity.lot
        );
        if (obj.lotquantity) {
          console.log("+++++++++++++++++++++");
          console.log(obj.lotquantity);
          return obj.lotquantity * this.newLotQuantity.quantity;
        }
      }
    }
  },

  methods: {
    selectShip(item) {
      this.newProduct.shipMethod.push(item);
    },

    remove(item) {
      this.newProduct.shipMethod.splice(
        this.newProduct.shipMethod.indexOf(item),
        1
      );
      this.newProduct.shipMethod = [...this.newProduct.shipMethod];
    },

    

    catItems() {
      axios
        .get(this.$baseUrl + "/category")
        .then(response => {
          response.data.catItems.forEach(element => {
            this.category.push(element);
          });
        })
        .catch(error => {
          console.log(error.response);
          console.log("ERROR");
        });
    },

    lotItems() {
      axios
        .get(this.$baseUrl + "/getLot")
        .then(response => {
          response.data.lotItems.forEach(element => {
            this.lotItem.push(element);
          });

          console.log(this.lotItem);

          //console.log(this.categoryItems);
        })
        .catch(error => {
          console.log(error.response);
          console.log("ERROR");
        });
    },

    methodItems() {
      axios
        .get("http://localhost:8000/api/getMethod")
        .then(response => {
          this.ShippingMethodItems = response.data.methodItems;

          //console.log(this.categoryItems);
        })
        .catch(error => {
          console.log(error.response);
          console.log("ERROR");
        });
    },
    addFile(fileKey, event) {
      this[fileKey] = event.target.files[0];
      console.log("File added", fileKey, event.target.files[0]);
    },

    /*selectFile(event) {
      this.file = this.$refs.file.files[0];

      let $Token = localStorage.getItem("token");
    },*/

    addProduct() {
      /*  axios

        .post(this.$baseUrl+"/test",{

          "c":this.colours,

          "b":this.border})

        .then(response => {

          console.log(response.data);

 

          //console.log(this.slideshowItems);

        })

        .catch(error => {

          console.log(error.response);

          console.log("ERROR");

        });

    }
       
      const formData = new FormData();
      formData.append("file", this.file, this.file.name);

      formData.append("details", this.newProduct.details);
      formData.append("price", this.newProduct.price);
      formData.append("slashedPrice", this.newProduct.slashedPrice);
      formData.append("size", this.newProduct.size);
      formData.append("border", this.newProduct.border);
      formData.append("colour", this.newProduct.colour);
      formData.append("cid", this.newProduct.cid);
      console.log("***************");
     
      for (var i = 0; i < this.newProduct.shipMethod.length; i++) {
        
        console.log(this.newProduct.shipMethod[i].shipId);
         formData.append("method["+i+"]", this.newProduct.shipMethod[i].shipId);
          console.log(this.newProduct.shipMethod[i].shipId);
         //console.log(method[i]);
    }
      //formData.append("method", this.newProduct.shipMethod);
      
      
      // this.newProduct.image = formData;*/

      let $Token = localStorage.getItem("token");

      var json_arr = JSON.stringify(this.newProduct.shipMethod);
      // console.log(json_arr);

      const formData = new FormData();
      formData.append("photoA", this.photoA, this.photoA.name);
      formData.append("photoB", this.photoB, this.photoB.name);
      formData.append("photoC", this.photoC, this.photoC.name);
      formData.append("photoD", this.photoC, this.photoD.name);
      /*formData.append("file", this.file, this.file.name);*/
      formData.append("method", json_arr);
      formData.append("details", this.newProduct.details);
      formData.append("price", this.newProduct.price);
      formData.append("slashedPrice", this.newProduct.slashedPrice);
      formData.append("size", this.newProduct.size);
      formData.append("border", this.newProduct.border);
      formData.append("colour", this.newProduct.colour);
      formData.append("cid", this.newProduct.cid);

      console.log("&&&&&&&&&&&&&&");
      console.log(this.photoA.name);
      console.log(this.photoB.name);
      console.log(this.photoC.name);
      console.log(this.photoD.name);

      axios
        .post(this.$baseUrl + "/addProduct?token=" + $Token, formData)

        .then(response => {
          console.log(response.data);
          this.dialog = false;
          this.productItems();
          console.log("Product Succesfully Added");
        })
        .catch(error => {
          console.log(error.response);
          console.log("ERROR");
        });
    },

    productItems() {
      (this.table_title = "Active Products"), (this.deletedItem = false);

      axios
        .get(this.$baseUrl + "/products")
        .then(response => {
          this.products = response.data.product;

          console.log(this.products);
        })
        .catch(error => {
          console.log(error.response);
          console.log("ERROR");
        });
    },

    getDeletedProducts() {
      (this.table_title = "Deleted Products"), (this.deletedItem = true);
      let $Token = localStorage.getItem("token");
      axios
        .post(this.$baseUrl + "/deletedProducts?token=" + $Token)
        .then(response => {
          this.products = response.data.product;

          //console.log(this.slideshowItems);
        })
        .catch(error => {
          console.log(error.response);
          console.log("ERROR");
        });
    },

    changeSort(column) {
      if (this.pagination.sortBy === column) {
        this.pagination.descending = !this.pagination.descending;
      } else {
        this.pagination.sortBy = column;
        this.pagination.descending = false;
      }
    },

    close() {
      this.showModal = false;
      this.showQuantity = false;
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      }, 300);
    },

    clear() {
      this.newProduct.size = "";
      this.newProduct.colour = "";
      this.newProduct.quantity = "";
      this.newProduct.price = "";
      this.newProduct.border = false;
      this.newProduct.details = "";
      this.newProduct.shipMethod = "";
      this.newProduct.cid = "";
      this.newProduct.slashedPrice = "";
      this.newProduct.shipMethod = "";
    },

    clearQuntity() {
      this.newLotQuantity.lot = "";
      this.newLotQuantity.quantity = "";
    },

    openDialogProduct() {
      this.newProduct.size = "";
      this.newProduct.colour = "";
      this.newProduct.quantity = "";
      this.newProduct.price = "";
      this.newProduct.border = false;
      this.newProduct.details = "";
      this.newProduct.shipMethod = "";
      this.newProduct.cid = "";
      this.newProduct.slashedPrice = "";
      this.newProduct.shipMethod = "";

      this.dialog = true;
    },

    editSave() {
      let $Token = localStorage.getItem("token");
      if (this.editedIndex > -1) {
        Object.assign(this.products[this.editedIndex], this.editedItem);

        axios
          .post(
            this.$baseUrl +
              "/editProduct/" +
              this.editedItem.PID +
              "?token=" +
              $Token,
            this.editedItem
          )
          .then(response => {
            this.showModal = false;
            this.productItems();
            console.log("Succesfully Edited");
          });
      } else {
        this.products.push(this.editedItem);
      }
      this.close();
    },

    editItem(item) {
      this.editedIndex = this.products.indexOf(item);
      this.editedItem = Object.assign({}, item);
      console.log(this.editedItem);
      this.showModal = true;
    },
    deletePhoto(){



      
    },

    deleteItem(item) {
      //var result = confirm("Want to delete product" + item.PID + "?");

      this.$dialog
        .confirm("Delete the selected product?", {
          html: false, // set to true if your message contains HTML tags. eg: "Delete <b>Foo</b> ?"
          loader: true, // set to true if you want the dailog to show a loader after click on "proceed"
          reverse: false, // switch the button positions (left to right, and vise versa)
          okText: "Yes, Delete!",
          cancelText: "Cancel",
          animation: "bounce", // Available: "zoom", "bounce", "fade"
          backdropClose: true // set to true to close the dialog when clicking outside of the dialog window, i.e. click landing on the mask
        })
        .then(dialog => {
          let $Token = localStorage.getItem("token");
          axios
            .post(
              this.$baseUrl + "/deleteProduct/" + item.PID + "?token=" + $Token
            )
            .then(response => {
              /*axios.get(item.deleteURL).then(res=>{
                            console.log(res);
                        });*/
              this.productItems();
              // alert("Product succesfully Deleted");

              this.$dialog
                .alert("Succesfully Deleted!", {
                  okText: "Dismiss!"
                })
                .then(function(dialog) {
                  console.log("Closed");
                });
            });

          setTimeout(() => {
            console.log("Delete action completed ");
            dialog.close();
          }, 2500);
        })
        .catch(() => {
          // Triggered when cancel button is clicked
          console.log("Delete aborted");
        });
    },

    restoreItem(item) {
      this.$dialog
        .confirm("Restore the selected file?", {
          html: false, // set to true if your message contains HTML tags. eg: "Delete <b>Foo</b> ?"
          loader: true, // set to true if you want the dailog to show a loader after click on "proceed"
          reverse: false, // switch the button positions (left to right, and vise versa)
          okText: "Yes, Restore!",
          cancelText: "Cancel",
          animation: "bounce", // Available: "zoom", "bounce", "fade"
          backdropClose: true // set to true to close the dialog when clicking outside of the dialog window, i.e. click landing on the mask
        })
        .then(dialog => {
          let $Token = localStorage.getItem("token");
          axios
            .post(
              this.$baseUrl + "/restoreProduct/" + item.PID + "?token=" + $Token
            )
            .then(response => {
              /*axios.get(item.deleteURL).then(res=>{
                            console.log(res);
                        });*/
              this.productItems();
              //  alert("Succesfully Restored");
              this.$dialog
                .alert("Succesfully Restored!", {
                  okText: "Dismiss!"
                })
                .then(function(dialog) {
                  console.log("Closed");
                });
            });

          setTimeout(() => {
            console.log("Delete action completed ");
            dialog.close();
          }, 2500);
        })
        .catch(() => {
          // Triggered when cancel button is clicked
          console.log("Delete aborted");
        });
    },

    selectFile(event) {
      this.file = this.$refs.file.files[0];
    },

    AddQuantity(item) {
      this.editedItem = Object.assign({}, item);
      this.clearQuntity();
      this.showQuantity = true;
    },

    DeleteQuntity() {
      var result = confirm(
        "Want to delete lot in product " + this.editedItem.PID + "?"
      );
      if (result) {
        const formData = new FormData();

        formData.append("lid", this.newLotQuantity.lot);
        formData.append("pid", this.editedItem.PID);
        formData.append("quantity", this.TotallotQuantity);
        console.log("**************************");
        console.log(this.newLotQuantity.lot);
        console.log(this.editedItem.PID);
        console.log(this.TotallotQuantity);

        //Logic to delete the item
        let $Token = localStorage.getItem("token");
        axios
          .post(this.$baseUrl + "/deleteProductLot?token=" + $Token, formData)
          .then(response => {
            this.showQuantity = false;
            /*axios.get(item.deleteURL).then(res=>{
                            console.log(res);
                        });*/
            this.productItems();
            //    alert("Product lot qunantity succesfully Deleted");
            this.$dialog
              .alert("Product Lot Qunantity Succesfully Deleted!", {
                okText: "Dismiss!"
              })
              .then(function(dialog) {
                console.log("Closed");
              });
          });
      }
    },

    SaveQuntity() {
      const formData = new FormData();

      formData.append("lid", this.newLotQuantity.lot);
      formData.append("pid", this.editedItem.PID);
      formData.append("quantity", this.TotallotQuantity);
      console.log("**************************");
      console.log(this.newLotQuantity.lot);
      console.log(this.editedItem.PID);
      console.log(this.TotallotQuantity);

      // this.newProduct.image = formData;

      let $Token = localStorage.getItem("token");

      axios
        .post(this.$baseUrl + "/addProductLot?token=" + $Token, formData)
        .then(response => {
          this.showQuantity = false;
          this.productItems();
          console.log("Product lot Succesfully Added");
        })
        .catch(error => {
          console.log(error.response);
          console.log("ERROR");
        });
    }
  }
};
</script>
<style>
.v-responsive {
  margin-bottom: 7px;
}

.container.grid-list-md.text-md-center.fluid.fill-height {
  padding-top: 0px;
  padding-bottom: 0;
}

.flex.md6.sm12.lg6.xs12.d-flex {
  padding-right: 30px;
}

.flex.md3.sm12.lg3.xs12.d-flex {
  padding: 0px;
  margin: 0px;
}
.v-card.v-card--flat.v-card--hover.v-sheet.theme--light {
  border: dashed;
  background: content-box;
  overflow: hidden;
  /* background-color: rgb(176, 190, 197);*/
  border-color: rgb(176, 190, 197);
  position: static;
  display: block;
  z-index: 10;
}






.card-5 {
  box-shadow: 0 19px 38px rgba(0, 0, 0, 0.3), 0 15px 12px rgba(0, 0, 0, 0.22);
}
.v-card--reveal {
  align-items: center;
  bottom: 0;
  justify-content: center;
  opacity: 0.5;
  position: absolute;
  width: 100%;
}
</style>



