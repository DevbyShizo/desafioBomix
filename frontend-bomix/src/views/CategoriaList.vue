<template>
    <div>
        <h1>Categorias</h1>
        <form @submit.prevent="adicionarCategoria">
            <input v-model="nome" placeholder="Nome da categoria" required>
            <button type="submit">Adicionar</button>
        </form>
        <ul>
            <li v-for="categoria in categorias" :key="categoria.id">
                {{ categoria.nome }}
                <button @click="editarCategoria(categoria)">Editar</button>
                <button @click="deletarCategoria(categoria.id)">Deletar</button>
            </li>
        </ul>
        <div v-if="categoriaEditando">
            <h2>Editar Categoria</h2>
            <form @submit.prevent="atualizarCategoria">
                <input v-model="categoriaEditando.nome" placeholder="Nome da categoria" required>
                <button type="submit">Atualizar</button>
            </form>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'CategoriaList',
    data() {
        return {
            categorias: [],
            nome: '',
            categoriaEditando: null
        };
    },
    created() {
        this.buscarCategorias();
    },
    methods: {
        buscarCategorias() {
            axios.get('http://localhost:8000/api/categorias')
                .then(response => {
                    this.categorias = response.data;
                })
                .catch(error => {
                    console.error('Erro ao buscar categorias:', error.response ? error.response.data : error.message);
                });
        },
        adicionarCategoria() {
            axios.post('http://localhost:8000/api/categorias', { nome: this.nome })
                .then(response => {
                    this.categorias.push(response.data);
                    this.nome = '';
                })
                .catch(error => {
                    console.error('Erro ao adicionar categoria:', error.response ? error.response.data : error.message);
                });
        },
        editarCategoria(categoria) {
            this.categoriaEditando = { ...categoria };
        },
        atualizarCategoria() {
            axios.put(`http://localhost:8000/api/categorias/${this.categoriaEditando.id}`, this.categoriaEditando)
                .then(response => {
                    const index = this.categorias.findIndex(c => c.id === response.data.id);
                    if (index !== -1) {
                        this.$set(this.categorias, index, response.data);
                    }
                    this.categoriaEditando = null;
                })
                .catch(error => {
                    console.error('Erro ao atualizar categoria:', error.response ? error.response.data : error.message);
                });
        },
        deletarCategoria(id) {
            axios.delete(`http://localhost:8000/api/categorias/${id}`)
                .then(() => {
                    this.categorias = this.categorias.filter(categoria => categoria.id !== id);
                })
                .catch(error => {
                    console.error('Erro ao deletar categoria:', error.response ? error.response.data : error.message);
                });
        }
    }
}
</script>
