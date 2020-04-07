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


/* Logistic curve */ 

l(t):=A/(B+exp(-t*C));

define(dl(t),diff(l(t),t));

Ist Lösung der Bernoullischen Differentialgleichung 
dl(t) = (B*C/A)*l(t)*(A/B-l(t));

mit k = B*C/A, G = A/B, 
siehe https://de.wikipedia.org/wiki/Logistische_Funktion 
https://www.stochastik-in-der-schule.de/sisonline/struktur/Jahrgang30-2010/Heft%201/2010-1_Engel.pdf
