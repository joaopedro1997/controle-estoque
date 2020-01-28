<template>
    <div class="container">
        <div v-if="!isCadastrar">
            <!--list-->
            <div class="card">
                <a class="btn btn-primary txCP" v-on:click="cadastrarProdutos">Cadastar novos produtos</a>
                <div class="card-header">
                    <h2>Listagem de produtos</h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" v-show="produtos.length>0">
                        <tr>
                            <td>#</td>
                            <td>descricao</td>
                            <td>valor</td>
                            <td>tipo</td>
                            <td>quantidade</td>
                            <td>ações</td>
                        </tr>
                        <tr v-for="(produto,index) in produtos" >
                            <td>{{produto.id}}</td>
                            <td>{{produto.descricao}}</td>
                            <td>{{produto.valor}}</td>
                            <td>{{produto.tipo}}</td>
                            <td>{{produto.quantidade}}</td>
                            <td>
                                <button class="btn btn-secondary" v-on:click="atualizarProduto(produto,index),btnAtualizar()" type="submit">editar</button>
                                <button class="btn btn-danger" v-on:click="deletarProduto(produto.id,index)" type="submit">apagar</button>
                            </td>

                        </tr>

                    </table>
                    <p v-show="produtos.length===0">NENHUM PRODUTO CADASTRADO ESTOQUE</p>
                </div>
            </div>
        </div>
<!--cadastro=============================================================================================================-->
    <div v-if="isCadastrar" class="container">
        <div class="card">
            <div class="card-header">
                <h2>Cadastro de produtos</h2>
                <form action="" v-on:submit.prevent>

                    <div class="card-body">

                        <div class="form-group">
                            <label for="">Descricão:</label>
                            <input required v-model="descricao" type="text" class="mb-2 form-control"placeholder="descrição">
                        </div>

                        <div class="form-group">
                            <label class="" >Valor:</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">R$</div>
                                </div>
                                <input required v-model="valor" type="number" class="form-control" placeholder="valor">
                                <input  v-model="id" type="hidden" class="form-control" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Quantidade:</label>
                            <input  v-model="quantidade" type="number" class=" form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Observação:</label>
                            <input  v-model="observacao" type="text" class=" form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Tipo:</label>
                            <select required v-model="tipo" class="custom-select mr-sm-2">
                                <option disabled value="">Escolha o tipo</option>
                                <option>Adulto</option>
                                <option>Infantil</option>
                            </select>
                        </div>

                        <button v-if="isAtualizar" class="btn btn-secondary" v-on:click="commitAtt()" type="submit">Salvar edição</button>
                        <button v-else  class="btn btn-success" v-on:click="salvarProduto()" >Salvar produto</button>
                        <button value="" v-on:click="sairCadastro()" class="btn btn-primary">Voltar para estoque</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                isCadastrar : false,
                descricao:'',
                valor: null,
                quantidade: null,
                observacao:'',
                tipo:'',
                descricaoUp:'',
                isAtualizar:false,
                commit:false,
                id:'',
                index:''
            }
        },


        props:['produtos'],
        mounted() {

        },
        methods:{

            deletarProduto(id,index){

                var r=confirm("Apagar mesmo o registro?");
                if (r==true)
                {
                    axios.delete(`produtos/${id}`).then((resposta)=>{
                        this.$emit('DelProduto',index)
                    });
                }
                else
                {
                    console.log('ação de apagar cancelada!')
                }



            },
            cadastrarProdutos(){
                this.isCadastrar=true;
                this.descricao='',
                this.valor='',
                this.quantidade='',
                this.observacao='',
                this.tipo=''
            },
            salvarProduto(){
                let params={
                    descricao:this.descricao,
                    valor:this.valor,
                    quantidade:this.quantidade,
                    observacao:this.observacao,
                    tipo:this.tipo
                };

                if (params.descricao!='' && params.tipo!='' && params.valor!=''){
                    axios.post('/produtos',params).then((resposta)=>{
                        const produto = resposta.data
                        this.descricao='',
                        this.valor='',
                        this.quantidade='',
                        this.observacao='',
                        this.tipo=''
                        this.$emit('addproduto', produto)

                    })
                    alert('salvo com sucesso!');
                }else
                    alert('Prencha os campos!')


            },
            sairCadastro(){
                this.isCadastrar=false;
                this.$emit('refazerGet')
                this.isAtualizar=false;

            },
            commitAtt(){

                const params = {
                descricao:this.descricao,
                valor:this.valor,
                quantidade:this.quantidade,
                observacao:this.observacao,
                tipo:this.tipo
                };

                if (params.descricao!='' && params.tipo!='' && params.valor!=''){
                    axios.put(`produtos/${this.id}`,params).then((resposta)=>{
                        const produtos = resposta.data
                        this.$emit('update',this.index,produtos)
                        this.$emit('refazerGet')
                        this.sairCadastro();
                    })
                }else{
                    alert('Preencha os campos necessários')
                }


            },

            btnAtualizar(){
                this.isAtualizar=true;
            },

            atualizarProduto(prod,index){
                this.isCadastrar=true;
                this.descricao = prod.descricao;
                this.valor = prod.valor;
                this.quantidade = prod.quantidade;
                this.observacao = prod.observacoes;
                this.tipo=prod.tipo;
                this.id=prod.id;
                this.index=index


            }
        }
    }
</script>

<style scoped>
.txCP{
    color: white;
}
</style>
