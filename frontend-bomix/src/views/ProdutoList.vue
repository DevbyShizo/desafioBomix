<template>
    <div>
        <h1>Produtos</h1>
        <form @submit.prevent="adicionarProduto">
            <input v-model="nome" placeholder="Nome do produto" required>
            <input v-model="valor" type="number" placeholder="Valor do produto" required>
            <input v-model="estabelecimento_id" type="number" placeholder="ID do estabelecimento" required>
            <button type="submit">Adicionar</button>
        </form>
        <ul>
            <li v-for="produto in produtos" :key="produto.id">
                {{ produto.nome }} - R$ {{ produto.valor }} - Estabelecimento ID: {{ produto.estabelecimento_id }}
                <button @click="editarProduto(produto)">Editar</button>
                <button @click="deletarProduto(produto.id)">Deletar</button>
            </li>
        </ul>
        <div v-if="produtoEditando">
            <h2>Editar Produto</h2>
            <form @submit.prevent="atualizarProduto">
                <input v-model="produtoEditando.nome" placeholder="Nome do produto" required>
                <input v-model="produtoEditando.valor" type="number" placeholder="Valor do produto" required>
                <input v-model="produtoEditando.estabelecimento_id" type="number" placeholder="ID do estabelecimento" required>
                <button type="submit">Atualizar</button>
            </form>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'ProdutoList',
    data() {
        return {
            produtos: [],
            nome: '',
            valor: '',
            estabelecimento_id: '',
            produtoEditando: null
        };
    },
    created() {
        this.buscarProdutos();
    },
    methods: {
        buscarProdutos() {
            axios.get('http://localhost:8000/api/produtos')
                .then(response => {
                    this.produtos = response.data;
                })
                .catch(error => {
                    console.error('Erro ao buscar produtos:', error.response.data);
                });
        },
        adicionarProduto() {
            axios.post('http://localhost:8000/api/produtos', {
                nome: this.nome,
                valor: this.valor,
                estabelecimento_id: this.estabelecimento_id
            })
            .then(response => {
                this.produtos.push(response.data);
                this.nome = '';
                this.valor = '';
                this.estabelecimento_id = '';
            })
            .catch(error => {
                console.error('Erro ao adicionar produto:', error.response.data);
            });
        },
        editarProduto(produto) {
            this.produtoEditando = { ...produto };
        },
        atualizarProduto() {
            axios.put(`http://localhost:8000/api/produtos/${this.produtoEditando.id}`, this.produtoEditando)
                .then(response => {
                    const index = this.produtos.findIndex(p => p.id === response.data.id);
                    this.$set(this.produtos, index, response.data);
                    this.produtoEditando = null;
                })
                .catch(error => {
                    console.error('Erro ao atualizar produto:', error.response.data);
                });
        },
        deletarProduto(id) {
            axios.delete(`http://localhost:8000/api/produtos/${id}`)
                .then(() => {
                    this.produtos = this.produtos.filter(produto => produto.id !== id);
                })
                .catch(error => {
                    console.error('Erro ao deletar produto:', error.response.data);
                });
        }
    }
}
</script>
