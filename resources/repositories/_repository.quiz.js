import Api from '../api.js';
import Quiz from "../models/model.quiz.js";

import QuizRepository from '../repositories/_repository.quiz.js';

class QuizRepository {

    constructor() {
        this.quizApi = new Api('ajax');

    }

    /**** @return {Promise}*/
    getAllQuizzes(){
        return new Promise(resolve => {
            this.quizApi.get('get-all-quizzes')
                .then(response => {
                    let quizzes =  response.map(Quiz.fromArray);
                    resolve(quizzes);
                })
                .catch(() => alert('something went wrong'));
        })
    }


}

export default new QuizRepository();