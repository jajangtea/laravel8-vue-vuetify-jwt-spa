<template>
  <v-dialog  v-model="dialog" persistent max-width="600px">
    <v-card>
      <v-card-title>
        <span class="text-h5">Edit Program Studi</span>
      </v-card-title>
      <v-form @submit.prevent="submit">
        <v-card-text>
          <v-container>
            <v-row>
              <v-col cols="12">
                <v-text-field
                  label="Kode Prodi*"
                  required
                  v-model="form.KodeJurusan"
                ></v-text-field>
              </v-col>
              <v-col cols="12">
                <v-text-field
                  label="Nama Prodi*"
                  required
                  v-model="form.NamaJurusan"
                ></v-text-field>
              </v-col>
            </v-row>
          </v-container>
          <small>*indicates required field</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" text @click="$emit('close')">
            Close
          </v-btn>
          <v-btn type="submit" color="blue darken-1" text>Save</v-btn>
        </v-card-actions>
      </v-form>
    </v-card>
  </v-dialog>
</template>

<script type="text/javascript">
import { mapActions, mapState } from "vuex";

export default {
  // props: ['prodi'],
  data() {
    return {
      form: {
        KodeJurusan: "",
        NamaJurusan: ""
      }
    };
  },



  computed: {
    prodi() {
       return this.$store.getters['prodi/getProdiByKode'](prodi.KodeJurusan)
    }
  },
  watch: {
    prodi: {
      immediate: true,
      handler(val) {
        console.log(val);
        this.form = {
          KodeJurusan: val.KodeJurusan,
          NamaJurusan: val.NamaJurusan
        };
      }
    }
  },

};
</script>

<style></style>
