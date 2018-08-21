import Answer from './model.answer';

export default class Question {
    constructor() {
        this.id =null;

        this.question = '';

        this.answers = [] ;
    }

    static fromArray(rawData){
        let question = new Question();
        question.id = rawData.id;
        question.question = rawData.question;
        question.answers = rawData.answers.map(Answer.fromArray);

        return question;
    }
}