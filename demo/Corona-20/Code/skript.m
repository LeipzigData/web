batchload("BasicData-Maxima.txt");
/* Mit der Datenfülle ist das lsquares mittlerweile überfordert */
load("lsquares");
/* Gauss- und Fehlerfunktion (Integral der Gaussverteilung) */
f(t):=exp(c-((t-m)/s)^2);  /* Gauss distribution */
g(t):=c-((t-m)/s)^2;       /* log of Gauss distribution */
h(t):=0.8862*exp(c)*s*(erf((t-m)/s)+erf(m/s)); /* Error function */

/* Logistische Funktion und deren Ableitung */
l(t):=K/(1+exp(c-r*t));
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

doublePlot(Land):=block([l,G,G1,G2,G3,G4],
  l:getData(Land),
  G:sublist(first(l),lambda([u],second(u)>5)),
  G1:map(first,G),
  G2:map(second,G),
  G3:Delta(G2)+.01, /* to avoid division by zero */
  G4:map(lambda([u1,u2,u3],[u1,u2/u3]),G1,G2,G3),
  plot2d([[discrete, G4]], [t,0,200], [y,0,30], [style, points])
  )$
  

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

lFit(G,K0):=block([G1,M,est,m],
  G1:map(lambda([u,v],[u,log(K0/v-1)]),map(first,G),map(second,G)),
  M:apply('matrix,float(G1)),
  est:lsquares_estimates(M,[t,y],y=c-r*t,[c,r]),
  m:float(subst(first(est),c/r)),
  define(l1(t),subst(append([K=K0],float(first(est))),l(t))),
  m)$

createLPlot(G,F,max):=
  plot2d([[discrete, G], F],
  [t,0,200], [y,0,max],
  [style, points, lines], [legend, false],
  [color, red, blue])$

selectData(l,von,bis):=
  sublist(first(l),lambda([u],first(u)>von and first(u)<bis and second(u)>10));
  
/* Computations */ 

l:getData(China);
G:selectData(l,80,130);
K0:7*10^4;
lFit(G,K0);
createLPlot(first(l),l1(t),2*10^5);
G1:map("[",map(first,G),Delta(map(second,G)));
define(dl1(t),diff(l1(t),t));
createLPlot(G1,dl1(t),2*10^4);

c-r*t = 4.664470054049377 - 0.10337267051424 t
c/r = 45.12285530445715

l:getData(Italy);
G:sublist(first(l),lambda([u],second(u)>10));
K0:3*10^5;
lFit(G,K0);
l1(t);
createLPlot(G,l1(t),5*10^5);
G1:map("[",map(first,G),Delta(map(second,G)));
define(dl1(t),diff(l1(t),t));
createLPlot(G1,dl1(t),2*10^4);

c-r*t = 17.44514126980632 - 0.206524088851644 t
c/r = 84.4702492905706

l:getData(Germany);
G:sublist(first(l),lambda([u],second(u)>10));
K0:1.25*10^5;
lFit(G,K0);
createLPlot(G,2*10^5);

c-r*t = 18.05781451219179 - 0.1981927723930733 t
c/r = 91.11237657233002

l:getData(Austria);
G:sublist(first(l),lambda([u],second(u)>10));
K0:1.3*10^4;
lFit(G,K0);
createLPlot(G,2*10^4);

c-r*t = 23.05255151797806 - 0.2683512133395708 t
c/r = 85.90440576397707

l:getData(Spain);
G:sublist(first(l),lambda([u],second(u)>10));
K0:1.6*10^5;
lFit(G,K0);
createLPlot(G,2*10^5);

c-r*t = 23.81533844331791 - 0.2693585413723537 t
c/r = 88.41501116683081

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
