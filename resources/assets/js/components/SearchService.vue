<template>
    <div class="container">
        <div class="col-md-12 card" style="padding:0.5cm">
            <span>
                <form action="/search" method="post" v-on:submit.prevent='submit'>
                    <span style="float:left;width:85%">

                        <input type='text' id="search" name="search" placeholder="search"
                         class="form-control" v-model='search' v-on:keyup='getresult'>
                    </span>
                    <span style="float:right;">
                        <input type="submit" value="search" class="btn">
                    </span>
                </form>
            </span>
        </div>
        <div class="col-md-12 card" style='padding:0.5cm;margin-top:0.2cm;' v-if="result.service.length>0 && search!=''">
            Reasults : {{ result.service.length }}
            <div class="card" style="padding:5px;" v-for="service in result.service" :key="service.id">
                <a :href="'/service/search/'+service.id">
                    <div>
                        <p>{{ service.name }} at {{ service.ask_price }} /=</p>

                    </div>
                </a>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        data(){
          return{
              search:'',
              result:{
                  service:{},

              },
              visible:false,
          };
        },

        mounted() {
            console.log('Component mounted.')
        },

        methods:{
            getresult(){
                if(this.search!=''){
                    axios.post('/search/fetch',{
                    search:this.search
                    })
                    .then(response=>{
                        this.result.service=response.data

                    })
                    .catch(error=>{

                    });
                }


            },

            submit(){
                this.getresult();

            }
        }
    }
</script>
