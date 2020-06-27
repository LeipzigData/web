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

/* Fit the Error function */
FitData(G,tr):=block([G1,G2,G3,est],
  /* G is already a Delta without zero values */
  G1:sublist(G,lambda([u],second(u)>tr)),
  G2:map(lambda([u],[first(u),float(log(second(u)))]),G1),
  /* Compute the parameter estimation */
  G3:apply('matrix,G2),
  est:lsquares_estimates(G3,[t,y],y=g(t),[c,s,m]),
  float(est))$

/* Fit the logistic function */
lFit(G,K0):=block([G1,M,est],
  G1:map(lambda([u,v],[u,log(K0/v-1)]),map(first,G),map(second,G)),
  M:apply('matrix,float(G1)),
  est:lsquares_estimates(M,[t,y],y=-r*(t-m),[m,r]),
  float(est))$

/* ====== Functions to plot the Results =============== */

createPlot(l,max):=block([G1:l[1]],
  plot2d([[discrete, G1], h1(t), l1(t)], 
  [t,0,200], [y,0,max],
  [style, points, lines, lines], [legend, false],
  [color, red, blue, green])
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
G:selectData(l[4],30,100);
est:FitData(G,20);
float(subst(est[1],[sqrt(%pi)*exp(c)*s,m,s]));
define(h1(t),subst(est[1],h(t))); 
G:selectData(l[1],30,100);
K0:1.57*10^5;
est:lFit(G,K0); 
define(l1(t),subst(append([K=K0],first(est)),l(t)));
createPlot(l,3*10^5);

K0:2.50*10^5;
G:selectData(l[1],70,120);
est:lFit(G,K0); /* [[m = 98.01283671826718, r = 0.08389925162207596]] */
define(h1(t),subst(append([K=K0],first(est)),l(t)));
G:selectData(l[1],100,140);
est:lFit(G,K0); /* [[m = 91.55551413278553, r = 0.04971720291484013]] */
define(l1(t),subst(append([K=K0],first(est)),l(t)));
createPlot(l,3*10^5);

/* ==== Spain, 46.66 Mio Einwohner ===== */

l:getData(Spain);
G:selectData(l[4],30,100);
est:FitData(G,20);
float(subst(est[1],[sqrt(%pi)*exp(c)*s,m,s]));
define(h1(t),subst(est[1],h(t))); 
G:selectData(l[1],30,100);
K0:1.71*10^5;
est:lFit(G,K0); 
define(l1(t),subst(append([K=K0],first(est)),l(t)));
createPlot(l,3*10^5);

/* ==== Germany, 82.79 Mio Einwohner ===== */

l:getData(Germany);
G:selectData(l[4],30,100);
est:FitData(G,20);
float(subst(est[1],[sqrt(%pi)*exp(c)*s,m,s]));
define(h1(t),subst(est[1],h(t))); 
G:selectData(l[1],30,100);
K0:1.36*10^5;
est:lFit(G,K0); 
define(l1(t),subst(append([K=K0],first(est)),l(t)));
createPlot(l,3*10^5);

K0:2.00*10^5;
G:selectData(l[1],70,120);
est:lFit(G,K0); /* [[m = 100.3440737849612, r = 0.116398353523995]] */
define(h1(t),subst(append([K=K0],first(est)),l(t)));
G:selectData(l[1],100,140);
est:lFit(G,K0); /* [[m = 86.97465162988513, r = 0.04118706120616364]] */
define(l1(t),subst(append([K=K0],first(est)),l(t)));
createPlot(l,3*10^5);

/* ==== Austria, 8.822 Mio Einwohner ===== */

l:getData(Austria);
G:selectData(l[4],30,100);
est:FitData(G,20);
float(subst(est[1],[sqrt(%pi)*exp(c)*s,m,s]));
define(h1(t),subst(est[1],h(t))); 
G:selectData(l[1],30,100);
K0:1.28*10^4;
est:lFit(G,K0); 
define(l1(t),subst(append([K=K0],first(est)),l(t)));
createPlot(l,3*10^4);

K0:1.8*10^4;
G:selectData(l[1],70,120);
est:lFit(G,K0); /* [[m = 95.29704641120715, r = 0.1156477748254564]] */
define(h1(t),subst(append([K=K0],first(est)),l(t)));
G:selectData(l[1],100,140);
est:lFit(G,K0); /* [[m = 54.56308240335213, r = 0.0266211630260425]] */
define(l1(t),subst(append([K=K0],first(est)),l(t)));
createPlot(l,3*10^4);

/* ==== China, Hubei, 58.5 Mio Einwohner ===== */

l:getData(China);
G:selectData(l[4],30,100);
est:FitData(G,20);
float(subst(est[1],[sqrt(%pi)*exp(c)*s,m,s]));
define(h1(t),subst(est[1],h(t))); 
G:selectData(l[1],30,100);
K0:7*10^4;
est:lFit(G,K0); 
define(l1(t),subst(append([K=K0],first(est)),l(t)));
createPlot(l,3*10^5);

/* ==== France, 66.99 Mio Einwohner ===== */

l:getData(France);
G:selectData(l[4],30,100);
est:FitData(G,20);
float(subst(est[1],[sqrt(%pi)*exp(c)*s,m,s]));

  [113777.4264476956, 95.0563011698473, 15.87565410295911]

/* ==== United Kingdom, 66.44 Mio Einwohner ===== */

l:getData(UK);
G:selectData(l[4],30,100);
est:FitData(G,20);
float(subst(est[1],[sqrt(%pi)*exp(c)*s,m,s]));

[249684.3017939618, 108.9794922481614, 18.66620412743644]

/* ==== Sweden, 66.44 Mio Einwohner ===== */

l:getData(Sweden);
G:selectData(l[4],30,100);
est:FitData(G,20);
float(subst(est[1],[sqrt(%pi)*exp(c)*s,m,s]));

[54401.90438304625, 20.08194639858018, 65.03143671223528]
/* Wenig plausible Werte, in Schweden ging die Pandemie deutlich später los */

G:selectData(l[4],80,120);
est:FitData(G,20);
float(subst(est[1],[sqrt(%pi)*exp(c)*s,m,s]));

[24618.88759744044, 108.1046532440499, 23.30424957051567]

define(h1(t),subst(est[1],h(t))); 
G:selectData(l[1],30,100);
K0:2.46*10^4;
est:lFit(G,K0); 
define(l1(t),subst(append([K=K0],first(est)),l(t)));
createPlot(l,5*10^4);

K0:5*10^4;
G:selectData(l[1],70,120);
est:lFit(G,K0); /* [[m = 161.7424036023588, r = 0.0738981860980454]] */
define(h1(t),subst(append([K=K0],first(est)),l(t)));
G:selectData(l[1],100,140);
est:lFit(G,K0); /* [[m = 236.0514878060304, r = 0.0308210722913995]] */
define(l1(t),subst(append([K=K0],first(est)),l(t)));

createPlot(l,7*10^4);

plot2d([[discrete, l[1]], h1(t), l1(t)], 
  [t,0,400], [y,0,10^5],
  [style, points, lines, lines], [legend, false],
  [color, red, blue, green])$


/* ############## Logistic curve ############### */ 

createLPlot(G,F1,F2,max):=
  plot2d([[discrete, G], F1, F2],
  [t,0,200], [y,0,max],
  [style, points, lines, lines], [legend, false],
  [color, red, blue, green])$
  
/* Computations */ 

l:getData(China);
K0:7*10^4;
G:selectData(l[1],30,100);
est:lFit(G,K0); /* [[m = 33.58032523260602, r = 0.07184843031845723]] */
define(l1(t),subst(append([K=K0],first(est)),l(t)));
G:selectData(l[2],30,100);
est:lFit(G,K0); /* [[m = 65.11708692759774, r = 0.1217529364825106]] */
define(l2(t),subst(append([K=K0],first(est)),l(t)));
createLPlot(l[1],l1(t),l2(t),10^5);

l:getData(Italy);
K0:2.5*10^5;
G:selectData(l[1],30,100);
est:lFit(G,K0); /* [[m = 91.39257150127692, r = 0.1738698331978473]] */
define(l1(t),subst(append([K=K0],first(est)),l(t)));
G:selectData(l[2],30,100);
est:lFit(G,K0); /* [[m = 101.7892236843653, r = 0.176900690094231]] */
define(l2(t),subst(append([K=K0],first(est)),l(t)));
createLPlot(l[1],l1(t),l2(t),3*10^5);

l:getData(Germany);
K0:2*10^5;
G:selectData(l[1],30,100);
est:lFit(G,K0); /* [[m = 91.39257150127692, r = 0.1738698331978473]] */
define(l1(t),subst(append([K=K0],first(est)),l(t)));
G:selectData(l[2],30,100);
est:lFit(G,K0); /* [[m = 108.7898911793164, r = 0.1950992509998804]] */
define(l2(t),subst(append([K=K0],first(est)),l(t)));
createLPlot(l[1],l1(t),l2(t),3*10^5);

l:getData(Spain);
K0:2.7*10^5;
G:selectData(l[1],30,100);
est:lFit(G,K0); /* [[m = 93.06663263139868, r = 0.2396490503343044]] */
define(l1(t),subst(append([K=K0],first(est)),l(t)));
G:selectData(l[2],30,100);
est:lFit(G,K0); /* [[m = 100.4909545691947, r = 0.2420645207693166]] */
define(l2(t),subst(append([K=K0],first(est)),l(t)));
createLPlot(l[1],l1(t),l2(t),3*10^5);

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
mean(l):=float(apply("+",l)/length(l));

l:getData(Germany)$
createDataPlot(l,2*10^5);
u:makelist(findDiff(l,10^4*u),u,5,15);
mean(u);

l:getData(Italy)$
createDataPlot(l,3*10^5);
u:makelist(findDiff(l,10^4*u),u,5,15);
mean(u);

l:getData(Spain)$
createDataPlot(l,2*10^5);
u:makelist(findDiff(l,10^4*u),u,5,15);
mean(u);

l:getData(Austria)$
createDataPlot(l,2*10^4);
u:makelist(findDiff(l,10^3*u),u,5,12);
mean(u);

/* #### R_0 */

showRValue(Land):=block([l,u,u1,u2],
  l:getData(Land),
  u:map(lambda([u,v],[u[1],u[2]/(v[2]+.1)*18]),l[4],l[3]),
  u1:sublist(u,lambda([u],u[1]>100)),
  u2:glD(u1,7),
  plot2d([[discrete, u1], [discrete, u2]],  
  [t,120,400], [y,0,2],
  [style, points, lines], [legend, false],
  [color, blue, green])
)$

plot2d([[discrete, u3]],   
  [t,0,300], [y,0,2*10^4],
  [style, points], [legend, false],
       [color, blue])$



/* #### Manfred Geilhaupt */

l:getData(Germany);

plot2d([[discrete, l[1]], [discrete, l[2]]],
  [t,120,200], [y,0,2.5*10^5],
  [style, points], [legend, false],
  [color, red, green])$

u:l[4];
v:glD(u,14);

plot2d([[discrete, u], [discrete, v]],
  [t,0,200], [y,0,10^4],
  [style, points], [legend, false],
  [color, red, green])$

plot2d([[discrete, l[3]], [discrete, l[4]]],
  [t,0,200], [y,0,10^5],
  [style, points], [legend, false],
  [color, red, green])$

u:l[6];
v:glD(u,7);

plot2d([[discrete, u], [discrete, v]],
  [t,0,200], 
  [style, points, lines], [legend, false],
  [color, blue, red])$


