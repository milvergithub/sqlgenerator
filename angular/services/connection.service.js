export class ConnectionService{
    constructor(API, $log, ToastService){
        'ngInject';
        this.$log=$log;
        this.API=API;
        this.ToastService=ToastService;
    }

    submit(){
        var data = {
            name:this.name,
            topic: this.topic
        }
        this.API.all('posts').post(data).then((response) => {
            this.ToastService.show('Post added successfully');
        });
    }

    connectionDBTest(project){
        this.API.all('connectiontest').post(project).then(function (data) {

        });
    }
}

