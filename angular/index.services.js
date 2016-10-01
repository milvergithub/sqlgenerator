import {ApplicationService} from './services/application.service';
import {ConnectionService} from './services/connection.service';
import {APIService} from './services/API.service';
import {DialogService} from './services/dialog.service';
import {ToastService} from './services/toast.service';

angular.module('app.services')
	.service('ApplicationService', ApplicationService)
	.service('ConnectionService', ConnectionService)
	.service('API', APIService)
	.service('DialogService', DialogService)
	.service('ToastService', ToastService)
