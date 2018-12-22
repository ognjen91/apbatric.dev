export function login(credentials){
  return new Promise((res, rej)=> {
    axios.post('/api/auth/login', credentials)
    .then((response)=>{
      setAuthorization(response.data.access_token);
      res(response.data);
    })
    .catch((error)=>{
      rej("Pogrešan email ili lozinka");
    })
  })
}

export function getLocalUser(){
  const userStr = localStorage.getItem('user');
  if (!userStr) return null;
  return JSON.parse(userStr);
}

function setAuthorization(token) {
    axios.defaults.headers.common["Authorization"] = `Bearer ${token}`
}
