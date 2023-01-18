<template>
    <div class="container">
        <div class="row justify-content-center">
            <div>
                <label>Время пуска</label>
                <datetime type="datetime"  v-model="content.date_start"  input-class="form-control  m-3" ></datetime>
                <label>Время останова</label>
                <datetime type="datetime"  v-model="content.date_stop"  input-class="form-control m-3" ></datetime>
               

                <label>Выбрать ДГУ</label>
              
                <select class="form-select m-3 " aria-label=""  v-model="content.des_select" >
                  
                    <option value="ADR16">ADR16</option>
                    <option value="SD6000E">SD6000E</option>
                  
                  </select>
               
                <label  class="" >Выбрать тип запуска</label>
                <select class="form-select m-3" aria-label=""  v-model="content.type_select">
                    <option value="Контрольный пуск">Контрольный пуск</option>
                    <option value="Авария промсети">Авария промсети</option>
                    <option value="Плановое отключение промсети">Плановое отключение промсети</option>
                </select>
               
                {{content.date_start}}
                <br>
                {{content.date_stop}}
                <br>
                {{content.des_select}}
                <br>
                {{content.type_select}}

                <br>
               
                <br>
                <button v-on:click="send_data" type="button" class="btn btn-success" >Сохранить </button>
                <button v-on:click="clear_data"  class="btn btn-info"  >Очистить</button>
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
                content: {
                 date_start: '',
                date_stop: '',
                des_select: '',
                type_select: ''   
                }
                

            }
        },
        methods:{
            send_data: function (){
                axios.post('des/add_time', {
                    content: this.content
                 
                })
                    .then(function (response) {
                        //console.log(response);
                        alert(response.data);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },

            clear_data: function () {
                     this.content.date_start  = '',
                     this.content.date_stop   = '',
                     this.content.des_select  = '',
                     this.content.type_select = ''
            },
            


        },
        mounted() {
          
        },
        
    }

</script>
