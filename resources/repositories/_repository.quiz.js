import Api from '../api.js';
import Quiz from "../models/model.quiz";
import Question from "../models/model.question.js";

class QuizRepository{

    constructor(){
        this.quizApi = new Api('ajax'); // change

    }

    /**
     *
     * @returns {Promise}
     */
    getAllQuizzes(){
        return new Promise(resolve => {
            this.quizApi.get('getAllQuizzes') // change
                .then(response => {

                    // data.result parāda uz
                    let quizzes = response.data.result.map(Quiz.fromArray);
                    resolve(quizzes);
                })
                .catch(() => alert('something went wrong'));
        })
    }

    start(name, quizId){
        return new Promise(resolve => {
            this.quizApi.post('start', {name, quizId})
                .then(response => {
                    let question =Question.fromArray(response.data.result);

                    resolve(question)

                })
                .catch(() => alert('oh nooo!'));
        })

    }
    answer(answerId) {
        return new Promise(resolve => {
            this.quizApi.post('answer' , {answerId})
                .then(response => {
                    resolve (
                        (typeof response.data.result === 'string') ?
                            response.data.result :
                            Question.fromArray(response.data.result)
                    );
                })
                .catch(() => {
                debugger;
                })
        })
    }
}

export default new QuizRepository();