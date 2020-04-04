batchload("BasicData.txt");
load("lsquares");
f(t):=exp(c-((t-m)/s)^2);  /* Gauss distribution */
g(t):=c-((t-m)/s)^2;       /* log of Gauss distribution */
h(t):=0.8862*exp(c)*s*(erf((t-m)/s)+erf(m/s)); /* Error function */

/* Extract increment list \Delta(S)=[s_i-s_{i-1},i=1..len(S)] from a list */
Delta(l):=l-append([0],reverse(rest(reverse(l))))$

/* Collect data for a given country into a single nested list */
getData(Land):=block([u,I,R,D],
  u:Land[infected],
  I:makelist([i+21,u[i]],i,1,length(u)),
  u:Land[recovered],
  R:makelist([i+21,u[i]],i,1,length(u)),
  u:Land[dead],
  D:makelist([i+21,u[i]],i,1,length(u)),
[I,R,D])$

/* == Fitting procedure == */
	 
FittingDelta(G,tr):=block([G1,G2,G3,G4,G5],
  /* tr is a lower threshold for data to be counted
     from the list of increments */ 
  /* Compute the Deltas */
  G1:map("[",map(first,G),Delta(map(second,G))),
  /* Filter out small entries */
  G2:sublist(G1,lambda([u],second(u)>tr)),
  /* Compute the log data */
  G3:map(lambda([u],[first(u),float(log(second(u)))]),G2),
  /* Compute the parameter estimation */
  G4:apply('matrix,G3),
  lsquares_estimates(G4,[t,y],y=g(t),[c,s,m])
)$

/* ====== Functions to compute the Fittings =============== */

getFittingFunctions(l,tr):=block([G,est],
  /* tr is a lower threshold for data to be counted
     from the list of increments */ 
  G:l[1],
  est:FittingDelta(G,tr),
  define(h1(t),subst(float(first(est)),h(t))),
  G:l[2],
  est:FittingDelta(G,tr),
  define(h2(t),subst(float(first(est)),h(t))),
  G:l[3],
  est:FittingDelta(G,tr),
  define(h3(t),subst(float(first(est)),h(t))),
  [h1(t),h2(t),h3(t)])$

/* ====== Functions to compute the Fittings =============== */

createPlot(l,max):=block([G1,G2,G3],
  G1:l[1], G2:l[2], G3:l[3],
  plot2d([[discrete, G1], h1(t), [discrete, G2], h2(t), [discrete, G3], h3(t)], 
  [t,0,200], [y,0,max],
  [style, points, lines], [legend, false],
  [color, red, red, green, green, blue, blue])
)$

/* ==== Italy, 60.48 Mio Einwohner ===== */

l:getData(Italy);
getFittingFunctions(l,50);
createPlot(l,2*10^5);

/* ==== Spain, 46.66 Mio Einwohner ===== */

l:getData(Spain);
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

/* ==== China, Hubei, 58.5 Mio Einwohner ===== */

l:getData(China);
getFittingFunctions(l,30);
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

/* ==== United Kingdom, 66.44 Mio Einwohner ===== */

l:getData(UK);
getFittingFunctions(l,20);
createPlot(l,5*10^4);

/* ==== Sweden, 66.44 Mio Einwohner ===== */

l:getData(Sweden);
getFittingFunctions(l,5);
createPlot(l,5*10^4);

/* Logistic curve */ 

l(t):=A/(B+exp(-t*C));

define(dl(t),diff(l(t),t));

Ist Lösung der Bernoullischen Differentialgleichung 
dl(t) = (B*C/A)*l(t)*(A/B-l(t));

mit k = B*C/A, G = A/B, 
siehe https://de.wikipedia.org/wiki/Logistische_Funktion 
https://www.stochastik-in-der-schule.de/sisonline/struktur/Jahrgang30-2010/Heft%201/2010-1_Engel.pdf
