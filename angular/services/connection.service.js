export class ConnectionService{
    constructor(API, $log, ToastService){
        'ngInject';
        this.$log=$log;
        this.API=API;
        this.ToastService=ToastService;
    }

    submit(){

    }

    connectionDBTest(project){
        this.API.all('connectiontest').post(project).then(function (data) {
            console.log(data);
        });
    }
}

