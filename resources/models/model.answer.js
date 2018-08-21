export default class Answer {
    constructor(){
        this.id = null;

        this.answer = '';
    }

    static fromArray(rawData){
        let answer = new Answer();
        answer.id = rawData.id;
        answer.answer = rawData.answer;

        return answer;
    }
}