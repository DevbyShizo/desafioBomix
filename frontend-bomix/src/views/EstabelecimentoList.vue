<template>
    <div>
        <h1>Estabelecimentos</h1>
        <form @submit.prevent="adicionarEstabelecimento">
            <input v-model="nome" placeholder="Nome do estabelecimento" required>
            <input v-model="descricao" placeholder="Descrição" required>
            <input v-model="categoria_id" type="number" placeholder="Categoria ID" required>
            <input v-model="cep" placeholder="CEP" required>
            <button type="submit">Adicionar</button>
        </form>
        <ul>
            <li v-for="estabelecimento in estabelecimentos" :key="estabelecimento.id">
                {{ estabelecimento.nome }} - {{ estabelecimento.endereco }}
                <button @click="editarEstabelecimento(estabelecimento)">Editar</button>
                <button @click="deletarEstabelecimento(estabelecimento.id)">Deletar</button>
            </li>
        </ul>
        <div v-if="estabelecimentoEditando">
            <h2>Editar Estabelecimento</h2>
            <form @submit.prevent="atualizarEstabelecimento">
                <input v-model="estabelecimentoEditando.nome" placeholder="Nome do estabelecimento" required>
                <input v-model="estabelecimentoEditando.descricao" placeholder="Descrição" required>
                <input v-model="estabelecimentoEditando.categoria_id" type="number" placeholder="Categoria ID" required>
                <input v-model="estabelecimentoEditando.cep" placeholder="CEP" required>
                <button type="submit">Atualizar</button>
            </form>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'EstabelecimentoList',
    data() {
        return {
            estabelecimentos: [],
            nome: '',
            descricao: '',
            categoria_id: '',
            cep: '',
            estabelecimentoEditando: null
        };
    },
    created() {
        this.buscarEstabelecimentos();
    },
    methods: {
        buscarEstabelecimentos() {
            axios.get('http://localhost:8000/api/estabelecimentos')
                .then(response => {
                    this.estabelecimentos = response.data;
                })
                .catch(error => {
                    console.error('Erro ao buscar estabelecimentos:', error.response ? error.response.data : error.message);
                });
        },
        adicionarEstabelecimento() {
            axios.post('http://localhost:8000/api/estabelecimentos', {
                nome: this.nome,
                descricao: this.descricao,
                categoria_id: this.categoria_id,
                cep: this.cep
            })
            .then(response => {
                console.log('Estabelecimento adicionado:', response.data);
                this.estabelecimentos.push(response.data);
                this.nome = '';
                this.descricao = '';
                this.categoria_id = '';
                this.cep = '';
            })
            .catch(error => {
                console.error('Erro ao adicionar estabelecimento:', error.response ? error.response.data : error.message);
            });
        },
        editarEstabelecimento(estabelecimento) {
            this.estabelecimentoEditando = { ...estabelecimento };
        },
        atualizarEstabelecimento() {
            axios.put(`http://localhost:8000/api/estabelecimentos/${this.estabelecimentoEditando.id}`, this.estabelecimentoEditando)
                .then(response => {
                    const index = this.estabelecimentos.findIndex(e => e.id === response.data.id);
                    if (index !== -1) {
                        this.$set(this.estabelecimentos, index, response.data);
                    }
                    this.estabelecimentoEditando = null;
                })
                .catch(error => {
                    console.error('Erro ao atualizar estabelecimento:', error.response ? error.response.data : error.message);
                });
        },
        deletarEstabelecimento(id) {
            axios.delete(`http://localhost:8000/api/estabelecimentos/${id}`)
                .then(() => {
                    this.estabelecimentos = this.estabelecimentos.filter(estabelecimento => estabelecimento.id !== id);
                })
                .catch(error => {
                    console.error('Erro ao deletar estabelecimento:', error.response ? error.response.data : error.message);
                });
        }
    }
}
</script>
