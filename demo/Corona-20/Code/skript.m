batchload("BasicData-Maxima.txt");
/* Mit der Datenfülle ist das lsquares mittlerweile überfordert */
load("lsquares");
/* Gauss- und Fehlerfunktion (Integral der Gaussverteilung) */
f(t):=exp(c-((t-m)/s)^2);  /* Gauss distribution */
g(t):=c-((t-m)/s)^2;       /* log of Gauss distribution */
h(t):=0.8862*exp(c)*s*(erf((t-m)/s)+erf(m/s)); /* Error function */

/* Logistische Funktion und deren Ableitung */
l(t):=K/(1+exp(-r*(t-m)));
define(dl(t),diff(l(t),t));

/* Extract increment list \Delta(S)=[s_i-s_{i-1},i=1..len(S)] from a list */
Delta(l):=l-append([0],reverse(rest(reverse(l))))$

/* Collect data for a given country into a single nested list. 
infected means positively tested
*/
getData(Land):=block([u,v,T,I,R,D,RD],
  u:Land[infected],
  v:Delta(u),
  T:makelist([i+21,u[i]],i,1,length(u)),
  DT:makelist([i+21,v[i]],i,1,length(u)),
  u:Land[recovered]+Land[dead],
  v:Delta(u),
  R:makelist([i+21,u[i]],i,1,length(u)),
  DR:makelist([i+21,v[i]],i,1,length(u)),
  u:Land[infected]-Land[recovered]-Land[dead],
  v:Delta(u),
  I:makelist([i+21,u[i]],i,1,length(u)),
  DI:makelist([i+21,v[i]],i,1,length(u)),
[T,R,I,DT,DR,DI])$

selectData(l,von,bis):=
  sublist(l,lambda([u],first(u)>von and first(u)<bis and second(u)>10));

/* Gleitender Durchschnitt */
glD(l,k):= makelist(sum(l[j],j,i+1,i+k)/k,i,0,length(l)-k);

/* == Fitting procedure == */
	 
FitData(G,tr):=block([G1,G2,G3],
  /* G is already a Delta without zero values */
  G1:sublist(G,lambda([u],second(u)>tr)),
  G2:map(lambda([u],[first(u),float(log(second(u)))]),G1),
  /* Compute the parameter estimation */
  G3:apply('matrix,G2),
  lsquares_estimates(G3,[t,y],y=g(t),[c,s,m])
)$

/* ====== Functions to compute the Fittings =============== */

getFittingFunctions(l,tr):=block([G,est1,est2],
  /* tr is a lower threshold for data to be counted
     from the list of increments */ 
  G:l[4],
  est1:FitData(G,tr),
  define(h1(t),subst(float(first(est1)),h(t))),
  G:l[5],
  est2:FitData(G,tr),
  define(h2(t),subst(float(first(est2)),h(t))),
  [est1,est2])$

/* ====== Functions to plot the Results =============== */

createPlot(l,max):=block([G1,G2],
  G1:l[1], G2:l[2], 
  plot2d([[discrete, G1], h1(t), [discrete, G2], h2(t)], 
  [t,0,200], [y,0,max],
  [style, points, lines], [legend, false],
  [color, red, red, green, green])
)$

createDataPlot(l,max):=block([G1,G2,G3],
  G1:l[1], G2:l[2], G3:l[3],
  plot2d([[discrete, G1], [discrete, G2], [discrete, G3]], 
  [t,0,200], [y,0,max],
  [style, points], [legend, false],
  [color, red, green, blue])
)$

doublePlot(Land,max):=block([l,G,G1,G2,G3,G4],
  l:getData(Land),
  G:sublist(first(l),lambda([u],second(u)>5)),
  G1:map(first,G),
  G2:map(second,G),
  G3:Delta(G2)+.01, /* to avoid division by zero */
  G4:map(lambda([u1,u2,u3],[u1,u2/u3]),G1,G2,G3),
  plot2d([[discrete, G4]], [t,0,200], [y,0,max], [style, points])
  )$

doublePlot(China,1000);

plotDoubling(h):=block([dh:diff(h,t)],
  plot2d(h/dh,[t,70,130],[y,0,30]))$

/* ==== Italy, 60.48 Mio Einwohner ===== */

l:getData(Italy);
getFittingFunctions(l,2000);
createPlot(l,4*10^5);

/* ==== Spain, 46.66 Mio Einwohner ===== */

l:getData(Spain);
getFittingFunctions(l,4000);
createPlot(l,4*10^5);
est:FitData(l[4]); 

getFittingFunctions(l,50);
createPlot(l,2*10^5);

G1:l[1]; G2:l[2]; G3:l[3];

plot2d([[discrete, G1], h1(t), [discrete, G2], [discrete, G3], h3(t)],
[t,0,200], [y,0,2*10^5],
[style, points, lines, points, points, lines], [legend, false],
[color, red, red, green, blue, blue]);

/* ==== Germany, 82.79 Mio Einwohner ===== */

l:getData(Germany);
getFittingFunctions(l,50);
createPlot(l,2*10^5);

/* ==== Austria, 8.822 Mio Einwohner ===== */

l:getData(Austria);
getFittingFunctions(l,5);
createPlot(l,2*10^4);
createDataPlot(l,2*10^4);

/* ==== China, Hubei, 58.5 Mio Einwohner ===== */

l:getData(China);
getFittingFunctions(l,50);
createPlot(l,8*10^4);

G1:l[1]; G2:l[2]; G3:l[3];

plot2d([[discrete, G1], h1(t), [discrete, G2], [discrete, G3], h3(t)],
[t,0,200], [y,0,8*10^4],
[style, points, lines, points, points, lines], [legend, false],
[color, red, red, green, blue, blue]);

/* ==== France, 66.99 Mio Einwohner ===== */

l:getData(France);
getFittingFunctions(l,50);
createPlot(l,2*10^5);

[77839.932039868 (erf(0.06166849415467176 (t - 96.50517888876705)) + 1.0),
 237197.164126429 (erf(0.01607662632224975 (t - 18.1603116862914)) +
 0.3203119900052553), 50947.64199538224 (erf(0.04540867065261457 (t -
 118.8091224882208)) + 0.9999999999999765)]

/* ==== United Kingdom, 66.44 Mio Einwohner ===== */

l:getData(UK);
getFittingFunctions(l,20);
createPlot(l,5*10^5);

[196824.2306944786 (erf(0.05008601857991169 (t - 113.5467493522619)) + 1.0),
 6709.57651974283 (erf(0.01204686689343318 (t - 12.03294609093242)) +
 0.1624305375465112), 19200.65893214914 (erf(0.009570296374754914 (t -
 30.89260209000159)) + 0.3241363474127178)]

/* ==== Sweden, 66.44 Mio Einwohner ===== */

l:getData(Sweden);
getFittingFunctions(l,5);
createPlot(l,2*10^4);

[6923.227489073069 (erf(0.0519430314276525 (t - 97.61801045485334)) + 1.0),
 2105.520183190281 (erf(0.06093028393001039 (t - 103.7114286910084)) + 1.0),
 347.3903236746284 (erf(0.1113184044913795 (t - 93.6891365970796)) + 1.0)]

/* ############## Logistic curve ############### */ 

lFit(G,K0):=block([G1,M,est],
  G1:map(lambda([u,v],[u,log(K0/v-1)]),map(first,G),map(second,G)),
  M:apply('matrix,float(G1)),
  est:lsquares_estimates(M,[t,y],y=-r*(t-m),[m,r]),
  define(l1(t),subst(append([K=K0],float(first(est))),l(t))),
  float(est))$

createLPlot(G,F,max):=
  plot2d([[discrete, G], F],
  [t,0,200], [y,0,max],
  [style, points, lines], [legend, false],
  [color, red, blue])$
  
/* Computations */ 

l:getData(China);
G:selectData(l[1],30,100);
K0:7*10^4;
lFit(G,K0); /* [[m = 33.58032523260602, r = 0.07184843031845723]] */
createLPlot(l[1],l1(t),10^5);
define(l2(t),subst([K=K0,m=45.12,r=0.103],l(t)));
plot2d([[discrete, G], l1(t), l2(t)],
  [t,0,200], [y,0,10^5],
  [style, points, lines, lines], [legend, false],
  [color, red, blue, green])$

G:selectData(l[1],22,62);
K0:7*10^4;
lFit(G,K0); /* [[m = 42.5123574904982, r = 0.2133141021473515]] */
createLPlot(l[1],l1(t),10^5);

define(dl1(t),diff(l1(t),t));
G1:l[4]; G2:glD(G1,7);
createLPlot(G1,dl1(t),7*10^3);

l:getData(Italy);
G:selectData(l[1],70,120);
K0:2.5*10^5;
lFit(G,K0); /* [[m = 103.1491179494895, r = 0.05599300970794591]] */
createLPlot(l[1],l1(t),5*10^5);
define(dl1(t),diff(l1(t),t));
G1:l[4]; G2:glD(G1,7);
createLPlot(G1,dl1(t),7*10^3);

l:getData(Germany);
G:selectData(l[1],70,120);
K0:2*10^5;
lFit(G,K0); /* [[m = 100.3440737849612, r = 0.116398353523995]] */
createLPlot(l[1],l1(t),2.5*10^5);

l:getData(Austria);
G:selectData(l[1],70,120);
K0:1.8*10^4;
lFit(G,K0); /* [[m = 95.29704641120715, r = 0.1156477748254564]] */
createLPlot(l[1],l1(t),2*10^4);

l:getData(Spain);
G:selectData(l[1],70,120);
K0:2.7*10^5;
lFit(G,K0); /* [[m = 100.8090116328231, r = 0.1179925484106326]] */ 
createLPlot(l[1],l1(t),3*10^5);

l:getData(Sweden);
G:selectData(l[1],100,150);
K0:5*10^4;
lFit(G,K0); /* [[m = 128.9620827373437, r = 0.04849480926061828]] */ 
createLPlot(l[1],l1(t),6*10^4);

/* #### Dynamics of infected */ 

fitInfectedWithGauss(l,max,c0,m0,s0):=block(
  [G:l[3],f:subst([c=c0,s=s0,m=m0],f(t))],
  plot2d([[discrete, G], f],
  [t,0,200], [y,0,max],
  [style, points, lines], [legend, false],
  [color, blue, red]))$

fitInfectedWithLogistic(l,max,K0,c0,r0):=block(
  [G:l[3],f:subst([c=c0,K=K0,r=r0],dl(t))],
  plot2d([[discrete, G], f],
  [t,0,200], [y,0,max],
  [style, points, lines], [legend, false],
  [color, blue, red]))$

l:getData(Austria);
fitInfectedWithGauss(l,10^4,9.14,93,12);
fitInfectedWithLogistic(l,10^4,1.3*10^4,33,0.268);

l:getData(China);
plotInfected(l,10^4,4.66,-0.1,5);

/* #### Wie lange dauert das Recovering ungefähr? */

findFirst(l,u):=part(sublist(l,lambda([x],second(x)>u)),1,1);
findDiff(l,u):=findFirst(second(l),u)-findFirst(first(l),u);

l:getData(Germany)$
makelist(findDiff(l,1000*u),u,1,10);
l:getData(China)$
makelist(findDiff(l,1000*u),u,1,10);
l:getData(Austria)$
makelist(findDiff(l,1000*u),u,1,10);
