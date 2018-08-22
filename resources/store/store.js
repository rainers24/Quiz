import Vue from 'vue';
import Vuex from 'vuex';
import * as types from './mutations.js';
import Question from '../models/model.question.js';

import QuizRepository from '../repositories/repository.quiz.js';


import Quiz from '../models/model.quiz.js';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        name: '',
        activeQuizId: null,
        allQuizzes: [],
        activeQuestion: null,
        result: '',
        allQuestions: [],

    },
    mutations: {
        [types.SET_ACTIVE_QUIZ](state, quizId){
            state.activeQuizId = quizId;
        },

        [types.SET_ALL_QUIZZES](state, quizzes){
            state.allQuizzes = quizzes;
        },

        [types.SET_NAME](state, name){
            state.name = name;
        },
        [types.SET_QUESTION](state , questions){
            state.activeQuestion = questions;
        },
        [types.SET_RESULTS](state , result){
            state.result = result;
        },
        [types.SET_ALL_QUESTIONS](state, questions) {
            state.allQuestions = questions;
        }


    },
    actions: {
        setActiveQuizId(context, quizId){
            context.commit(types.SET_ACTIVE_QUIZ, quizId);
        },

        setAllQuizzes(context)
        {
            QuizRepository.getAllQuizzes()
                .then(quizzes => {
                    context.commit(types.SET_ALL_QUIZZES, quizzes);
                });
            // context.commit(types.SET_ALL_QUIZZES,
            //     // [
            //     //     {
            //     //         id: 1,
            //     //         name: 'Prog',
            //     //     },
            //     //
            //     //     {
            //     //         id: 2,
            //     //         name: 'rip',
            //     //     },
            //     //
            //     // ].map(Quiz.fromArray)

        },


        setName(context, name){
            context.commit(types.SET_NAME, name);
        },

        start(context){
            QuizRepository.start(this.state.name, this.state.activeQuizId)
                .then(question => context.commit(types.SET_QUESTION, question));
        },
        answer(context , answerId) {
            QuizRepository.answer(answerId)
                .then (questionOrResults => {
                    if (questionOrResults instanceof Question) {
                        context.commit(types.SET_QUESTION, questionOrResults);
                    } else {
                        context.commit(types.SET_QUESTION, null);
                        context.commit(types.SET_RESULTS, questionOrResults);
                    }
                })
        },
        restart (context) {
            context.commit(types.SET_ACTIVE_QUIZ , null)
        }


    }

});