import toastr from 'toastr';
import 'toastr/build/toastr.min.css';

export default function useToastr() {
    toastr.options.progressBar = true;
    toastr.options.closeButton = true;
    return toastr;
}
