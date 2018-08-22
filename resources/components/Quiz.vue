<template>
    <div class="quiz">
        <div v-if="!activeQuestion && !result">

            <div class="quiz__title" >
                <label>Your name</label>
                <input class="quiz__input"  type="text" v-model="name" />
            </div>

            <div >
                <label class="quiz__select-text">Pick your quiz</label>
                <select class="quiz__select" v-model="activeQuizId">
                    <option v-for="quiz in allQuizzes" :value="quiz.id">{{ quiz.name }}</option>
                </select>
            </div>

            <div>
                <button class="quiz__start" @click="onStart">Start</button>
            </div>
        </div>

        <div v-else-if="activeQuestion">
            <div class="quiz__greeting">Hello, {{name}}!</div>
            <QuestionItem />
        </div>
        <Results />
    </div>
</template>

<script>
    import {mapActions}  from 'vuex';
    import * as types from '../store/mutations.js';
    import QuestionItem from "./QuestionItem.vue";
    import Results from './Results.vue';


    export default{
        name: 'Quiz',
        components : {QuestionItem , Results},
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

                set(newValue){
//                    this.$store.commit(types.SET_ACTIVE_QUIZ, newValue)
                    this.setActiveQuizId(newValue);
                }
            },
            allQuizzes: {
                get(){
                    return this.$store.state.allQuizzes;
                }
            },
            activeQuestion: {
                get(){
                    return this.$store.state.activeQuestion;
                }
            },
            result: {
                get() {
                    return this.$store.state.result;
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