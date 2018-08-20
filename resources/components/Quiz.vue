<template>
    <div >
        <input v-model="name" />
        <select v-model="activeQuizId">
            <option v-for="Quiz in allQuizzes">{{Quiz.name}}</option>
        </select>
        <button @click="onStart">Start</button>
    </div>

</template>

<script>
    import {mapActions}  from 'vuex';
    import * as types from '../store/mutations.js';

    export default{
        name: 'Quiz',
        computed: {
            name: {
                get(){
                    return this.$store.state.name;
                },
                set(newName){
                    this.setName(newName);
                }
            },

            activeQuizId: {
                get() {
                    return this.$store.state.activeQuizId;
                },
                set(newName){
                    this.setName(newName);

                },
                set(newValue){
//                    this.$store.commit(types.SET_ACTIVE_QUIZ, newValue)
                    this.setActiveQuizId(newValue);
                }
            },
            allQuizzes: {
                get(){
                    return this.$store.state.allQuizzes;
                }
            }
        },
        methods: Object.assign({}, mapActions([
            'setAllQuizzes',
            'setActiveQuizId',
            'setName',
            'start',
        ]), {
            onStart(){
                if (!this.name){
                    alert('Give me your name');
                    return;
                }
                if(!this.activeQuizId){
                    alert('pick a quiz');
                    return;
                }
                this.start();
            }
            //add methods here
        }),

        created(){
            this.setAllQuizzes();
        }
    }

</script>