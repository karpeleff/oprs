<template>
    <div class="container">
        <div class="row justify-content-center">
            <div>

                  <div mt-5></div>
                  <label>Запись</label>
                    <div mt-5></div>
                  <div class="input-group m-3">

                    <input type="text" class="form-control" v-model="text" placeholder="" >
                  </div>

                  <div mt-5></div>
                <br>
                <button v-on:click="send_data" type="button" class="btn btn-success" >Сохранить </button>

            </div>
            <List
                v-for="text in notes"
                :text="text.text"
                :key="text.id"
                v-bind:note_data="text"
            />

        </div>
    </div>
</template>

<script>
import List from './List.vue'

    export default {
        data: function () {
            return {
                 text: '',
                 notes: [],
                   }
        },

components: {
    List
},
        methods:{
            send_data: function (){
                axios.post('add_note', {
                    text:  this.text,
                })
                    .then(function (response) {
                        //console.log(response);
                        alert(response.data);
                       // this.get_data();
                       // this.text =  '' ;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                },

           get_data(){
                        axios
                           .get('/notes')
                           .then(response => (this.notes = response.data))

                },


                 },

        mounted() {
            this.get_data();
           // console.log(this.notes);
          },

    }

</script>
