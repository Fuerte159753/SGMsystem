import { Injectable } from '@angular/core';
import { HttpClient} from '@angular/common/http';
import { FormGroup } from '@angular/forms';

@Injectable({
  providedIn: 'root'
})
export class ServiceService {
  constructor(private http:HttpClient) { }
  url='http://localhost/noveno/'

  login(loginData: { email: string; password: string }){
    const formData = new FormData();
    formData.append('email', loginData.email);
    formData.append('password', loginData.password);
    return this.http.post<any>(this.url + 'login.php', formData);
  }
  idtec() {
    return this.http.get<any>(this.url + 'obtenid.php');
  }
  regtec(formData: FormData) {
    return this.http.post<any>(this.url + 'registrot.php', formData);
  }
  
}
