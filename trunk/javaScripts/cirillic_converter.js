// JavaScript Document
/* 
   Menuvanje na kodna tastatura od latinicna
   vo Kirilicna Windows-1251
*/
C=new Array(
  'А','Б','В','Г','Д','Е','З','Ѕ','И','Ј','К','Л','Љ','М','Н','Њ','О',
  'П','Р','С','Т','У','Ф','Х','Ц','Џ',
  'а','б','в','г','д','е','з','ѕ','и','ј','к','л','љ','м','н','њ','о',
  'п','р','с','т','у','ф','х','ц','џ')

L=new Array(
  'A','B','V','G','D','E','Z','Y','I','J','K','L','Q','M','N','W','O',
  'P','R','S','T','U','F','H','C','X',
  'a','b','v','g','d','e','z','y','i','j','k','l','q','m','n','w','o',
  'p','r','s','t','u','f','h','c','x')

//------------------------------------
Cyr=new Array()
	
	for (q=0;q<59;q++) {
	//  if (q==27 || q==57) continue
	  Cyr[L[q]]=C[q]
	
}

Cyr[unescape('%5C')]=('ж')
Cyr[unescape('%7C')]=('Ж') 
Cyr[unescape('%5D')]=('ѓ')
Cyr[unescape('%7D')]=('Ѓ')   
Cyr[unescape('%27')]=('ќ')
Cyr[unescape('%22')]=('Ќ')
Cyr[unescape('%3B')]=('ч')
Cyr[unescape('%3A')]=('Ч') 
Cyr[unescape('%5B')]=('ш')
Cyr[unescape('%7B')]=('Ш')
//Cyr[unescape('%62')]=unescape('%E1')

function toCyr(lat) {
  cyr=''
  for (q=0;q<lat.length;q++) {
    ch=lat.charAt(q)
    chL=ch.toLowerCase()
    nxt=lat.charAt(q+1).toLowerCase()


   
 if (Cyr[ch]) cyr+=Cyr[ch]
    else cyr+=ch
  }
  return cyr
}