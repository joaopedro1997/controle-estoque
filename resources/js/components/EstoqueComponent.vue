<template>

    <table-component @update="atualizarLista" @refazerGet="refazerGet" @addproduto="addproduto" @DelProduto="apagaLista" :produtos="produtos" v-bind:produtos="produtos"  ></table-component>

</template>

<script>
    export default {
        data(){
            return{
                produtos:[]
                }
            },
        mounted() {
            axios.get('produtos').then((resposta)=>{
               this.produtos = resposta.data;
            });
        },
        methods:{
            addproduto(produto){
                this.produtos.push(produto)
            },
            apagaLista(index){
                this.produtos.splice(index,1);
            },
            atualizarLista(index,produs){
                this.produtos[index]=produs;
            },
            refazerGet(){
                axios.get('produtos').then((resposta)=>{
                    this.produtos = resposta.data;
                })
            }
        }

    }
</script>

<style scoped>

</style>
