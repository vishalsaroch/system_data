if('serviceWorker' in navigator){
    try{
      navigator.serviceWorker.register('sw.js');
      console.log('sw regitered');
    }
    catch(error){
      console.log('sw not registed');
    }
  }