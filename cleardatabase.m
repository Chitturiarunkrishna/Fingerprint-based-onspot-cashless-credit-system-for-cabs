fprintf(['>> Clearing database... ']);
delete database.mat

person = struct('Name', [], 'Age', [], 'FID1', [], 'FID2', []);
person = struct2table(person);

minutiae = struct('ID', [], 'X', [], 'Y', [], 'Type', [], 'Angle', [],'S1', [], 'S2', []);
minutiae = struct2table(minutiae);

save database person minutiae


conn = database('matlab', 'root' , ''); 
conn.Message
sqlquery = 'DELETE FROM pdata';
data = fetch(conn,sqlquery);
tail(data)

sqlqueryt = 'DELETE FROM ridehistory';
datat = fetch(conn,sqlqueryt);
tail(datat)
close(conn)

fprintf(['done!\n']);