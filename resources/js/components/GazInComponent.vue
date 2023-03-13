<template>
    <div class="container">
        <div class="row justify-content-center">
            <div>
                <label>Дата</label>
                <datetime type="date"  v-model="date"  input-class="form-control  m-3" ></datetime>

                <div mt-5></div>
                <label>Тип топлива</label>
              
                <select class="form-select m-3 " aria-label=""  v-model="type" >
                  
                    <option value="D">Дизтопливо</option>
                    <option value="B">Бензин</option>
                  
                  </select>
                  <div mt-5></div>
                  <label>Количество:  л</label>
                    <div mt-5></div>
                  <div class="input-group m-3">
                  
                    <input type="number" class="form-control" v-model="count" placeholder="количество" >
                  </div>
                
                  <div mt-5></div>
                <label>Загрузить документ</label>
              
           
               
                <br>
                <button v-on:click="send_data" type="button" class="btn btn-success" >Сохранить </button>
              
            </div>
        </div>
    </div>
</template>

<script>
 import { Datetime } from 'vue-datetime';
    // You need a specific loader for CSS files
    import 'vue-datetime/dist/vue-datetime.css';
    import { Settings } from 'luxon';

    Settings.defaultLocale = 'ru';

    //Vue.use(Datetime)
    Vue.component('datetime', Datetime);

///////




    export default {
        data: function () {
            return {
               
                 date: '',
                 type: '',
                 count: ''
                
            }
        },
        methods:{
            send_data: function (){
                axios.post('fuel_add', {
                    date:  this.date,
                    type:  this.type,
                    count: this.count,
                 
                })
                    .then(function (response) {
                        //console.log(response);
                        alert(response.data);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },

          
            


        },
        mounted() {
          
        },
        
    }

</script>
