<template>
    <div>
        <h1>
            {{ question.question }}
        </h1>

        <ul>
            <li v-for="answer in question.answers">
                <AnswerItem :answer="answer" :on-answered="onAnswerPicked"></AnswerItem>
            </li>
        </ul>

        <button @click="onAnswered">Next question</button>
    </div>
</template>

<script>
    import {mapActions} from 'vuex';
    import AnswerItem from "./AnswerItem";
    export default{
        name: 'QuestionItem',
        components: {AnswerItem},
        data(){
            return{
                answerId: null,
            }
        },
        computed: {
            question: {
                get() {
                    return this.$store.state.activeQuestion;
                }
            }
        },
        methods: Object.assign({}, mapActions([
            'answer'
        ]), {
            onAnswerPicked(answerId) {
                this.answerId = answerId;
            },
            onAnswered() {
                if (!this.answerId) {
                    alert('No answer picked');
                    return;
                }
                this.answer(this.answerId);
            }
        })
    }

</script>