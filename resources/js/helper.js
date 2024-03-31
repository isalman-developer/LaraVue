import moment from "moment";
import { string } from "yup";

export function formateDate(date) {
    if(date){
        return moment(string(date)).format('YYYY-MM-DD');
    }
}
