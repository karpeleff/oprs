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
            <div class="alert alert-success  mt-4 " role="alert"   v-for="item in notes"  >
  {{ item.text }}
</div>

        </div>
    </div>
</template>

<script>


///////




    export default {
        data: function () {
            return {
                 text: '',
                 notes: null       
                   }
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
          },
        
    }

</script>
