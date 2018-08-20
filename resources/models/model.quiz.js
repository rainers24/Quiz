export default class  Quiz {

    constructor(){
        /**
         *
         * @type {null}
         */
        this.id = null;
        /**
         *
         * @type {string}
         */
        this.name = '';
    }

    /**
     *
     * @param {{}} rawData
     * @returns {Quiz}
     */
    static fromArray(rawData){
        let quiz = new Quiz();
        quiz.id = rawData.id;
        quiz.name = rawData.name;

        return quiz;

    }

}